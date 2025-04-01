<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Paciente;
use App\Models\Tratamiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;
use App\Models\Especialidade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $busqueda = $request->input('busqueda');

    // Filtrar pacientes según rol
    if (Auth::user()->hasRole('Admin')) {
        $pacientes = Paciente::with(['tratamientos', 'pagos'])
            ->when($busqueda, function ($query, $busqueda) {
                return $query->where('nombres', 'LIKE', "%{$busqueda}%");
            })
            ->orderBy('nombres', 'asc')
            ->paginate(10);
    } else {
        $pacientes = Paciente::with(['tratamientos', 'pagos'])
            ->where('nombres', Auth::user()->name)
            ->orderBy('nombres')
            ->paginate(10);
    }

    // Calcular deudas de manera eficiente
    $deudas = $pacientes->map(function ($paciente) {
        $totalTratamientos = Tratamiento::where('pacientes_id', $paciente->id)->sum('presupuesto');
        $totalPagos = Pago::where('paciente_id', $paciente->id)->sum('monto');
        $saldo = $totalTratamientos - $totalPagos;

        return [
            'paciente' => $paciente->nombres,
            'deudaTotal' => $saldo,
            'paciente_id' => $paciente->id
        ];
    });

    // Si es una solicitud AJAX, retornar solo la tabla
    if ($request->ajax()) {
        return view('pago.tabla', compact('deudas', 'pacientes'))->render();
    }

    return view('pago.index', compact('deudas', 'pacientes'));
}



    public function generarPDF($id)
    {
        // Obtener el paciente
        $paciente = Paciente::findOrFail($id);

        $especialidad = Especialidade::pluck('descripcion','id');

        // Calcular el total de los tratamientos
        $totalTratamientos = Tratamiento::where('pacientes_id', $id)->sum('presupuesto');
        
        // Calcular el total de los pagos
        $totalPagos = Pago::where('paciente_id', $id)->sum('monto');
        
        // Calcular el saldo pendiente
        $saldo = $totalTratamientos - $totalPagos;

        // Obtener los tratamientos y pagos
        $tratamientos = Tratamiento::where('pacientes_id', $id)->get();
        $pagos = Pago::where('paciente_id', $id)->get();

        // Generar el PDF
        $pdf = Pdf::loadView('pdf.pagos', compact('paciente', 'tratamientos', 'especialidad','pagos', 'saldo', 'totalTratamientos', 'totalPagos'));

        // Mostrar la vista previa en el navegador en lugar de descargar el archivo
        return $pdf->stream('factura_pagos_' . $paciente->nombres . '.pdf');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id): RedirectResponse
    {
        // Validar el monto ingresado
        $request->validate([
            'monto' => 'required|numeric|min:1', // Asegura que el monto sea un número válido y mayor a 0
        ]);
    
        // Buscar al paciente
        $paciente = Paciente::with(['tratamientos', 'pagos'])->findOrFail($id);
    
        // Calcular la deuda actual
        $totalTratamientos = Tratamiento::where('pacientes_id', $paciente->id)->sum('presupuesto');
        $totalPagos = Pago::where('paciente_id', $paciente->id)->sum('monto');
        $saldo = $totalTratamientos - $totalPagos;
    
        // Verificar que el pago no sea mayor a la deuda
        if ($request->monto > $saldo) {
            return redirect()->route('pagos.show', $paciente->id)->with('error', 'El monto excede la deuda actual.');
        }
    
        // Registrar el nuevo pago
        $nuevoPago = new Pago();
        $nuevoPago->paciente_id = $paciente->id;
        $nuevoPago->fecha_pago = now();
        $nuevoPago->monto = $request->monto;
        $nuevoPago->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('pagos.show', $paciente->id)->with('success', 'Pago registrado correctamente.');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paciente = Paciente::findOrFail($request->paciente_id);
    
        $nuevoPago = new Pago();
        $nuevoPago->paciente_id = $paciente->id;
        $nuevoPago->fecha_pago = $request->fecha_pago;
        $nuevoPago->monto = $request->monto;
        $nuevoPago->save();
    
        return redirect()->route('pagos.show', $paciente->id)->with('success', 'Pago realizado correctamente');
    }
    /**
     * Display the specified resource.
    **/

    public function show(Request $request, $id): View
{
    // Obtener el valor del parámetro 'busnombre' para filtrar tratamientos (búsqueda exacta)
    
        $busnombre = $request->busnombre;

        // 1. Obtener el paciente y cargar los pagos
        $paciente = Paciente::with('pagos')->findOrFail($id);

        // 2. Consultar los tratamientos asociados al paciente
        $tratamientosQuery = Tratamiento::where('pacientes_id', $id);
        
        if (!empty($busnombre)) {
            $tratamientosQuery->where('nombres', $busnombre);
        }

        // Paginar los tratamientos (10 por página)
        $tratamientos = $tratamientosQuery->paginate(10);

        // 3. Calcular totales
        $totalTratamientos = $tratamientosQuery->sum('presupuesto');  // SUMA DESDE LA BASE DE DATOS
        $totalPagos = Pago::where('paciente_id', $id)->sum('monto');   // SUMA DESDE LA BASE DE DATOS
        $saldo = $totalTratamientos - $totalPagos;

        // 4. Retornar la vista
        return view('pago.show', compact('paciente', 'tratamientos', 'totalTratamientos', 'totalPagos', 'saldo'))
            ->with('i', ($request->input('page', 1) - 1) * $tratamientos->perPage());

        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pago = Pago::find($id);

        return view('pago.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagoRequest $request, Pago $pago): RedirectResponse
    {
        $pago->update($request->validated());

        return Redirect::route('pagos.index')
            ->with('success', 'Pago updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Pago::find($id)->delete();

        return Redirect::route('pagos.index')
            ->with('success', 'Pago deleted successfully');
    }



}

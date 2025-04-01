<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SexoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sexos = Sexo::paginate();

        return view('sexo.index', compact('sexos'))
            ->with('i', ($request->input('page', 1) - 1) * $sexos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sexo = new Sexo();

        return view('sexo.create', compact('sexo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SexoRequest $request): RedirectResponse
    {
        Sexo::create($request->validated());

        return Redirect::route('sexos.index')
            ->with('success', 'Sexo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sexo = Sexo::find($id);

        return view('sexo.show', compact('sexo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sexo = Sexo::find($id);

        return view('sexo.edit', compact('sexo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SexoRequest $request, Sexo $sexo): RedirectResponse
    {
        $sexo->update($request->validated());

        return Redirect::route('sexos.index')
            ->with('success', 'Sexo updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Sexo::find($id)->delete();

        return Redirect::route('sexos.index')
            ->with('success', 'Sexo deleted successfully');
    }
}

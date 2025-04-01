<?php
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use App\Http\Requests\LoginRequest; // Asegúrate de importar tu LoginRequest
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;
    
    class LoginController extends Controller
    {
        use AuthenticatesUsers;
    
        protected $redirectTo = '/home';
    
        public function __construct()
        {
            $this->middleware('guest')->except('logout');
            $this->middleware('auth')->only('logout');
        }
    
        // Sobrescribir credentials para que use 'name' en lugar de 'email'
        protected function credentials(LoginRequest $request)
        {
            return [
                'name' => $request->name,  // Usamos 'name' en lugar de 'email'
                'password' => $request->password,
            ];
        }
    
        public function login(LoginRequest $request)
        {
            // Intentar autenticar al usuario
            if ($this->attemptLogin($request)) {
                // Redirigir a la carpeta /home
                return redirect($this->redirectTo);
            }
    
            // Si la autenticación falla, puedes lanzar una excepción de validación con un mensaje personalizado
            throw ValidationException::withMessages([
                'name' => [trans('auth.failed')], // Mensaje de error genérico para 'name'
            ]);
        }
    }
    

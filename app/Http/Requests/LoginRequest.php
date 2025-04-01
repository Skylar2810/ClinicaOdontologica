<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia esto según tus necesidades de autorización
    }

    public function rules()
    {
        return [
            'name' => 'required|string', // Asegúrate de validar 'name' correctamente
            'password' => 'required|string|min:6',
           // 'g-recaptcha-response' => 'required|captcha', // Validación del CAPTCHA
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'El reCAPTCHA es obligatorio.',
            'g-recaptcha-response.captcha' => 'El reCAPTCHA no es válido.',
        ];
    }

    
}

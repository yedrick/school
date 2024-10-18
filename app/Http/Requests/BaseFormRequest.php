<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest {
    protected function failedValidation(Validator $validator)
    {
        $response = redirect()
            ->back()
            ->withErrors($validator) // Mantiene los mensajes de error de validación
            ->with('message_warning', 'La validación ha fallado. Por favor, verifica los datos ingresados.') // Mensaje personalizado global
            ->withInput();

        throw new HttpResponseException($response);
    }
}

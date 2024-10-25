<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

class StoreProductRequest extends BaseFormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        // validacion policy
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|max:5',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'El Nombre no puede ser mayor a 5 caracteres',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
        ];
    }

    // // despues de la vlaidacion de los campos se puede hacer una validacion personalizada
    // public function withValidator($validator) {
    //     $validator->after(function ($validator) {
    //         // cambiar el request con un nuevo
    //         $this->merge([
    //             'name' => strtoupper($this->name),
    //             'description' => strtoupper($this->description),
    //         ]);
    //     });
    // }
}

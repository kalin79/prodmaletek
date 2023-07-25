<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return User::updateValidation($this);
    }

    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        
        $validator->after(function($validator) { 
            
            $password = request()->password;
            if($password!=""){
                if (!check_pcomplex($password,8,5)) {
                    $validator->errors()->add('password', 'La contraseña debe tener al menos un caracter especial, un número y una letra Mayuscula.');
                    return $validator;
                } 
            }
            
            
        });
        
        return $validator;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return User::attributesValidation();
    }
}

<?php

namespace App\Http\Requests;

use App\User;
use App\Events\UserCreated;
use Illuminate\Foundation\Http\FormRequest;

class StoresUser extends FormRequest
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
        return [
            'is_admin'   => 'required',
            'last_name'  => 'required|string',
            'first_name' => 'required|string',
            'email'      => 'required|string|email',
        ];
    }

    public function store()
    {
        $user = User::create([
            'is_admin'   => $this->is_admin,
            'last_name'  => $this->last_name,
            'first_name' => $this->first_name,
            'email'      => $this->email,
        ]);

        event(new UserCreated($user));

        return $user;
    }

    public function messages()
    {
        return [
            //
        ];
    }
} 

<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdatesUser extends FormRequest
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
            'last_name'  => 'string',
            'first_name' => 'string',
        ];
    }

    public function update(User $user)
    {
        return $user->update([
            'is_admin'   => $this->is_admin,
            'last_name'  => $this->last_name,
            'first_name' => $this->first_name,
            'email'      => $this->email,
            'password'   => bcrypt($this->password),
        ]);
    }
}

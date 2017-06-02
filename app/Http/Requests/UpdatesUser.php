<?php

namespace App\Http\Requests;

use App\User;
use Carbon\Carbon;
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
            'is_admin'         => 'required',
            'last_name'        => 'required|string',
            'first_name'       => 'required|string',
            'password'         => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ];
    }

    public function update(User $user)
    {
        $user->fill([
            'is_admin'   => $this->is_admin,
            'last_name'  => $this->last_name,
            'first_name' => $this->first_name,
            'email'      => $this->email,
            'password'   => bcrypt($this->password),
            // 'updated_at' => Carbon::now(),
        ]);

        $user->save();
        return $user;
    }
}

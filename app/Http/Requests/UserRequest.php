<?php
/**
 * Author: Joshua Matikinye
 * Company: Sams Web Hosting
 * Project: bottlestore
 * Date: 8/6/2015
 * Time: 12:07 AM
 */

namespace App\Http\Requests;


class UserRequest extends Request
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

}
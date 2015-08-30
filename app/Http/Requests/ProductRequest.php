<?php namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ProductRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
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
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'image' => 'required'
        ];
    }

}

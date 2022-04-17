<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Post;
use Illuminate\Validation\Rule;



class FormPostRequest extends FormRequest
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
            'title' => ['required', 'unique:posts,title,'.$this->title.',title', 'min:3'],
            'description' => ['required', 'min:10'],
            'post_creator' => ['exists:App\Models\User,id'],
            
        ];
    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
public function messages()
{
    return [
        'title.required' => 'customized message, title is required!',
        'description.required' => 'customized message, description is required!',
    ];
}
}

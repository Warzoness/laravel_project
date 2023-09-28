<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:50|unique:categories,id,'.$this->request->get('id'),
            'status'=>'required'
        ];
    }

    public function messages(){
        return[
            'name.required'=>'Category name not allow to empty',
            'name.unique'=>'Category '.$this->name.' already exist',
            'name.min'=>'Category Name not long enough',
            'name.max'=>'Category Name too long',
            'status.required'=>'Status not allow to empty'
        ];
    }
}
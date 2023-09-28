<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
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
            'name'=>'required|min:2|max:50|unique:categories',
            'status'=>'required'
        ];
    }

    public function messages(){
        return[
            'name.unique'=>'Category name '.$this->name.' already exists',
            'name.required'=>'Category name not allow to empty',
            'name.min'=>'Category Name not long enough',
            'name.max'=>'Category Name too long',
            'status.required'=>'Status not allow to empty'
        ];
    }
}
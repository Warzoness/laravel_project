<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:50|unique:products,id,'.$this->request->get('id'),
            'price'=>'required|min:1|numeric',
            'sale_price'=>'required|min:1|lte:price|numeric',
            'photo'=>'required|image',
            'photos'=>'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Name not allow to empty',
            'name.min'=>'Name too short',
            'name.max'=>'Name too long',
            'name.unique'=>'Product '.$this->name.' already exist',
            'price.required'=>'Price not allow to empty',
            'price.min'=>'Price is illegal',
            'price.numeric'=>'Price is illegal',
            'sale_price.required'=>'sale price not allow to empty',
            'sale_price.min'=>'sale price is illegal',
            'sale_price.numeric'=>'sale price is illegal',
            'sale_price.lte'=>'Sale Price must be small or equal price',
            'photo.required'=>'Image not allow to empty',
            'photo.image'=>'Image is illegal',
            'photos.required'=>'Image not allow to empty',
        ];
    }
}
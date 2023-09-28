<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductsRequest;
use App\Http\Requests\Admin\Products\UpdateProductsRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImg;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5)->withQueryString();
        return view('admin.pages.products.indexPro',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        try {
            
            return view('admin.pages.products.add-product',compact('categories'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        $fileName = $request->photo->getClientOriginalName();
        
        $request->photo->storeAs('public/uploads/images',$fileName);

        $request->merge(['image'=>$fileName]);

        try {
            $products = Product::create($request->all());
            if($products && $request->hasFile('photos')){
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/uploads/images',$fileNames);
                    ProductImg::create([
                        'product_id' => $products->id,
                        'product_img' => $fileNames
                    ]);
                }
                alert()->success('Add success', 'Add success !');
                return redirect()->route('products.index');
            };
        } catch (\Throwable $th) {
            alert()->error('Add fail', 'Add fail !');
            return redirect()->back();
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($item)
    {
        $productImgs = ProductImg::where('product_id',$item)->get();
        $product = Product::find($item);
        $categories = Category::all();
        return view('admin.pages.products.edit-product',compact('product','categories','productImgs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $item)
    {
        $fileName = $request->photo->getClientOriginalName();
        
        $request->photo->storeAs('public/uploads/images',$fileName);

        $request->merge(['image'=>$fileName]);

        try {
            $products = Product::find($item)->update($request->all());
            if($products && $request->hasFile('photos')){
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/uploads/images',$fileNames);
                    ProductImg::create([
                        'product_id' => $products->id,
                        'product_img' => $fileNames
                    ]);
                }
                alert()->success('Update success', 'Update success !');
                return redirect()->route('products.index');
            };
        } catch (\Throwable $th) {
            alert()->error('Update fail', 'Update fail !');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
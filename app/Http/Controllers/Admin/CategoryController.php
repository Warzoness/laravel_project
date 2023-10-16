<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoriesRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoriesRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::paginate(5)->withQueryString();
        return view('admin.pages.categories.indexCate',compact('categories'));
    }

    public function search(Request $request) {
        $query = $request->get('query');
        if($request->ajax()){
            $output = '';
            $categories = Category::where('name','LIKE',$query.'%')->get();
            if($categories){
                foreach ($categories as $key => $value) {
                    $output .= '<tr>
                    <td>' . $categories->id . '</td>
                    <td>' . $categories->parent_id . '</td>
                    <td>' . $categories->name . '</td>
                    <td>' . $categories->status . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.categories.add-category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        Category::create($request->all());
        try {
            alert()->success('Add success', 'Add success !');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Fail', 'Add Fail !');
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($item)
    {
        $subCategory = Category::where('parent_id',$item)->paginate(5);


        if($subCategory->isEmpty()){
            $products = Product::where('category_id',$item)->paginate(5);
            return view('admin.pages.products.productOfSubCategory',compact('products'));
        }else{
            return view('admin.pages.categories.sub-category',compact('subCategory'));
        };

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($item)
    {
        $category = Category::find($item);
        $categories = Category::all();
        return view('admin.pages.categories.edit-category',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $item)
    {
        Category::find($item)->update($request->all());
        try {
            alert()->success('Add success', 'Update success !');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Fail', 'Update Fail !');
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        Category::destroy($item);
        try {
            toast('One Category be gone forever , R.I.P !','success','top-right');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Fail', 'Delete Fail !');
            return  redirect()->back();
        };
    }

    public function trashIndex(){
        $categories = Category::onlyTrashed()->get();
        return view('admin.pages.categories.trash-category',compact('categories'));
    }

    public function trashRestore($id){
        Category::withTrashed()->where('id',$id)->restore();
        try {
            alert()->success('Add success', 'Restore success !');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Fail', 'Restore Fail !');
            return  redirect()->back();
        }
    }


    public function forceDelete($id){
        Category::withTrashed()->where('id',$id)->forceDelete();
        try {
            toast('One Category be gone forever , R.I.P !','success','top-right');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Fail', 'Delete Fail !');
            return  redirect()->back();
        }
    }
    
}
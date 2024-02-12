<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProviderLicence;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // all category
    public function categories()
    {
        $categories = Category::all();
        return view('dashboard.category.categories',[
            'categories' => $categories
        ]);
       
    }
  
    // add category
    public function addCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        Category::create($data);
        return redirect()->back();
    }
    // edit category
    public function updatedCategory(Request $request)
    {
        $category = Category::find($request->category_id)->update(['name'=>$request->name]);
        return redirect()->back();
    }
    // delete category
    public function deleteCategory($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return redirect()->back();
    }
}

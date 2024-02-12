<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProviderLicence;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::all();
        $lawyersByCategory = [];

        foreach ($categories as $category) {
            $providers = ProviderLicence::where('category_id', $category->id)->get();
            $final = array('category' => $category,'providers'=>$providers);
            array_push($lawyersByCategory , $final);
            // $lawyersByCategory[$category->name] = $provider;
        }

        return response()->json([
            'categories' => $lawyersByCategory
        ]);
    }
}


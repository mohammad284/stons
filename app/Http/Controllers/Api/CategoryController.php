<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::all();

        return response()->json([
            'details' => $categories
        ]);
    }
}

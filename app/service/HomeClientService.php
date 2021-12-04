<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class HomeClientService
{

    public function viewIndexHomeCustomer()
    {
        $sliders = Slider::where('status', '=', '1')->get();
        $products = Product::all()->random(6);
        $categories = Category::where('parent_id', '=', '0')->with('categoryChild')->get();
        return view('customer.home-customer', compact('sliders', 'products', 'categories'));
    }
}

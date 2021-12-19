<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeClientService
{

    public function viewIndexHomeCustomer()
    {
        $sliders = Slider::where('status', '=', '1')->get();
        $products = Product::where('status', '=', 1)->get();
        if ($products->count() > 6) {
            $products =  $products->random(6);
        }
        $categories = Category::where('parent_id', '=', '0')->with('categoryChild')->get();
        return view('customer.home-customer', compact('sliders', 'products', 'categories'));
    }
    public function ShowDetailsProducts($id)
    {
        $categories = Category::where('parent_id', '=', '0')->with('categoryChild')->get();
        $products =  Product::with(['images', 'user_product'])->find($id);
        return view('customer.product-details-customer', compact('products', 'categories'));
    }
}

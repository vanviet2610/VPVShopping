<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->ViewProductAll();
        return view('admin.product.index-product', compact('products'));
    }
    public function create()
    {
        $categoryAll = $this->productService->ViewCategoryAll('');
        return view('admin.product.add-product', compact('categoryAll'));
    }
    public function store(ProductRequest $req)
    {
        return $this->productService->createProduct($req);
    }
    public function detail($id)
    {
        $products =  $this->productService->ShowDetailsProduct($id);
        return view('admin.product.details-product', compact('products'));
    }
    public function approved(Request $req)
    {
        return $this->productService->ApprovedProduct($req);
    }
    public function edit($id)
    {
        return $this->productService->ViewEditProducts($id);
    }
    public function update($id, ProductRequest $req)
    {
        return $this->productService->UpdateProduct($id, $req);
    }
    public function delete($id)
    {
        return $this->productService->deleteProduct($id);
    }
}

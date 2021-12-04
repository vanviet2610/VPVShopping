<?php

namespace App\Service;

use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tags;
use App\Traits\ImageFunctions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService
{
    protected $product;
    use ImageFunctions;

    function __construct()
    {
    }

    public function ViewProductAll()
    {
        return Product::paginate(10);
    }

    public function ViewCategoryAll($idSelectedOptions)
    {
        $recusive = new Recusive(Category::all());
        $categoryOptions = $recusive->getOptionsChildrent($idSelectedOptions);

        return $categoryOptions;
    }
    public function createProduct($req)
    {
        try {
            DB::beginTransaction();
            $dataImageFeature  = $this->CreateLoadFile($req->file('imagefeature'), 'products');
            $idProduct = 'product' . date('Y-m-d-H-i-s') . '-' . mt_rand(1000, 9999);
            $idFinishCreateProduct = Product::create([
                'id' => $idProduct,
                'title' => $req->title,
                'content' => $req->content,
                'price' => $req->price,
                'file_name' => $dataImageFeature['file_name'],
                'file_path' => $dataImageFeature['file_path'],
                'user_id' => Auth::id(),
                'category_id' =>  $req->category,
                'status' => 0
            ]);

            foreach ($req->file('imagemutil') as $value) {
                $dataMutipleImage = $this->CreateLoadFile($value, 'products');
                $idFinishCreateProduct->images()->create(
                    [
                        'file_path' => $dataMutipleImage['file_path'],
                        'file_name' => $dataMutipleImage['file_name'],
                    ]
                );
            }
            foreach ($req->tags as $key => $tagItem) {
                $tags =  Tags::firstOrCreate(
                    [
                        'name' => $tagItem,
                    ],
                    [
                        'name' => $tagItem,
                        'slug' => Str::slug($tagItem),
                    ]
                );
                $tagsID[] = $tags->id;
            }
            $idFinishCreateProduct->tags()->attach($tagsID);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'create product success',
            ]);
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Error Create Product =>>>  " . $err->getMessage() . "== Line Error =>>>  " . $err->getLine());
            return response()->json([
                'code' => 404,
                'message' => 'create product fails',
            ]);
        }
    }

    public function ShowDetailsProduct($id)
    {
        return Product::with('images')->findOrFail($id);
    }

    public function ApprovedProduct($req)
    {
        $idProduct = Product::find($req->id);
        if (empty($idProduct)) {
            return response()->json(
                [
                    'code' => 403,
                    'message' => 'product not found',
                ]
            );
        } else {
            $idProduct->status = 1;
            $idProduct->save();
            $products = $idProduct->fresh();
            $renderViewContentDetailsProduct = view('admin.product.partials-product.details-content-product', compact('products'))->render();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'approved products success',
                    'renderview' => $renderViewContentDetailsProduct
                ]
            );
        }
    }

    public function ViewEditProducts($id)
    {
        $products = Product::with(['images', 'tags'])->find($id);
        $categoryAll = $this->ViewCategoryAll($products->category_id);
        return view('admin.product.edit-product', compact('products', 'categoryAll'));
    }

    public function UpdateProduct($id, $req)
    {
        $products = Product::find($id);
        try {
            DB::beginTransaction();
            if ($req->hasFile('imagemutil')) {
                $products->update([
                    'title' => $req->title,
                    'content' => $req->content,
                    'price' => $req->price,
                    'user_id' => Auth::id(),
                    'category' => $req->category,
                    'status' => 0
                ]);
                if (!empty($products->images()->get())) {
                    foreach ($products->images()->get() as $key => $value) {
                        if (File::exists(public_path($value->file_path))) {
                            File::delete(public_path($value->file_path));
                        }
                    }
                }
                $products->images()->delete();
                foreach ($req->file('imagemutil') as $key => $value) {
                    $imageAdditionalProduct = $this->CreateLoadFile($value, 'products');
                    $products->images()->create($imageAdditionalProduct);
                }
            }

            if ($req->hasFile('imagefeature')) {
                $dataImageFeature = $this->CreateLoadFile($req->file('imagefeature'), 'products');

                if (File::exists(public_path($products->file_path))) {
                    File::delete(public_path($products->file_path));
                }

                $products->update([
                    'title' => $req->title,
                    'content' => $req->content,
                    'price' => $req->price,
                    'file_name' => $dataImageFeature['file_name'],
                    'file_path' => $dataImageFeature['file_path'],
                    'user_id' => Auth::id(),
                    'category_id' => $req->category,
                    'status' => 0
                ]);
            }
            if (!$req->hasFile('imageFeature') && !$req->hasFile('imagemutil')) {
                $products->update([
                    'title' => $req->title,
                    'content' => $req->content,
                    'price' => $req->price,
                    'user_id' => Auth::id(),
                    'category' => $req->category,
                    'status' => 0
                ]);
            }

            foreach ($req->tags as $key => $tagItem) {
                $tags =  Tags::firstOrCreate(
                    [
                        'name' => $tagItem,
                    ],
                    [
                        'name' => $tagItem,
                        'slug' => Str::slug($tagItem),
                    ]
                );
                $tagsID[] = $tags->id;
            }
            $products->tags()->sync($tagsID);
            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'update product success'
            ]);
        } catch (\Exception $err) {
            Log::debug("Product Update Err =>>>>> " . $err->getMessage() . "  Line =>>>" . $err->getLine());
            DB::rollBack();
            return response()->json([
                'code' => 404,
                'message' => 'update product fails'
            ]);
        }
    }

    public function deleteProduct($id)
    {
        $deleteProducts = Product::find($id);

        $products =  Product::oldest()->paginate(10);
        $viewRenderIndexProductTableProduct = view('admin.product.partials-product.view-table-product', compact('products'))->render();
        $viewRenderPaginationProduct = view('admin.product.partials-product.view-pagination-product', compact('products'))->render();
        if (!empty($deleteProducts)) {
            $deleteProducts->delete();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'delete product success',
                    'content' => $viewRenderIndexProductTableProduct,
                    'pagination' => $viewRenderPaginationProduct
                ],
            );
        } else {
            return response()->json(
                [
                    'code' => 404,
                    'message' => 'delete product fails'
                ]
            );
        }
    }
}

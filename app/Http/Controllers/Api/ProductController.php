<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends

{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {

        $list = Product::query();
        if ($request->has('q'))
            $list->where('name', 'like', '%' . $request->query('q') . '%');

        $list->orderBy($request->query('sort', 'id'), $request->query('order', 'DESC'));

        $list = $list->paginate(10);

        return $this->showAll(ProductsResource::collection($list)->resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request)
    {

        Validator::make($request->all(), []);

        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return $this->createAt(ProductResource::make($product), ['msg' => 'ürün eklendi']);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product)
            $product = ProductResource::make($product);

        return $this->showOne($product, ['code' => 404, 'msg' => 'Ürün Bulunamadı. #1']);

        /*
        try {
            $product = Product::find($id);
            if ($product)
                return $this->showOne(ProductResource::make($product));
            else
                return $this->showOne(null, ['code' => 404, 'msg' => 'Ürün Bulunamadı. #1']);

        } catch (ModelNotFoundException $exception) {
            return $this->showError(['code' => 404, 'msg' => 'Ürün Bulunamadı. #2']);
        }
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product)
    {

        Validator::make($request->all(), []);

        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->description = $request->description;
        $product->save();

        return $this->updateAt(ProductResource::make($product), ['msg' => 'ürün güncellendi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $productOld = ProductResource::make($product);
        $product->delete();
        return $this->deleteAt($productOld, ['msg' => 'ürün silindi']);
    }
}

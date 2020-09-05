<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductsResource;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * @param \Illuminate\Http\Request $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
        //$input = $request->all();

        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return $this->createAt(ProductResource::make($product), ['msg' => 'ürün eklendi']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            if ($product)
                return $this->showOne(ProductResource::make($product));
        } catch (ModelNotFoundException $exception) {
            //
        }

        return $this->showError(['code' => 404, 'msg' => 'Ürün Bulunamadı']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

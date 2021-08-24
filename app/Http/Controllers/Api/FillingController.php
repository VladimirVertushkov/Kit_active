<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductSetStorageRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Notifications\User;
use Illuminate\Http\Request;

class FillingController extends Controller
{
    public function createProduct(ProductRequest $request)
    {
        $user = auth()->user();
        $admin = \App\Models\User::where('id', 2)->first();
        $data = $request->validated();
        $data['customer_id'] = $user->id;
        $createdProduct = Product::create($data);
        //return $admin;
        $admin->notify((new User())->delay(['database' => now()->addMinutes(1)]));
        return new ProductResource($createdProduct);
    }

    public function addStorage(ProductSetStorageRequest $request, Product $product)
    {
      // return $a = $product->only('customer_id');
        $user = \App\Models\User::where('id', $product->only('customer_id'))->first();
        $product->update($request->validated());

        $user->notify((new User())->delay(['database' => now()->addMinutes(1)]));
        return new ProductResource($product);
    }
}

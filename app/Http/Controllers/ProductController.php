<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller {

  public function show(Request $request) {
    return Product::latest()->get();
  }

  public function store(Request $request) {
    $this->validateProduct($request);
    $product = new Product();
    $product->fill([
      'name' => $request->input('name'),
      'category' => $request->input('category'),
      'price' => $request->input('price'),
      'discount' => $request->input('discount'),
      'description' => $request->input('description'),
      'user_id' => $request->input('userID')
    ]);
    $product->save();
    if($request->hasFile('image')) {
      $image = $request->file('image');
      $path = 'img/';
      $filename = $product->id.'.'.$image->getClientOriginalExtension();
      $image->move($path, $filename);
      $product->img = $filename;
      $product->save();
    }
    return $product;
  }

  public function update(Request $request, $id) {
    $this->validateProduct($request);
    $product = Product::findOrFail($id);
    $product->name = $request->input('name');
    $product->category = $request->input('category');
    $product->price = $request->input('price');
    $product->discount = $request->input('discount');
    $product->description = $request->input('description');
    $product->save();
    if($request->hasFile('image')) {
      $image = $request->file('image');
      $path = 'img/';
      $filename = $product->id.'.'.$image->getClientOriginalExtension();
      $image->move($path, $filename);
      $product->img = $filename;
      $product->save();
    }
    return $product;
  }

  public function destroy($id) {
    $product = Product::findOrFail($id);
    if($product->img != '') {
      unlink("img/".$product->img);
    }
    $product->delete();
    return $product;
  }

  public function validateProduct(Request $request) {
    $this->validate($request, [
      'name' => 'required|min:2|max:255',
      'category' => 'required|min:2|max:255',
      'price' => 'required|numeric',
      'discount' => 'required|numeric',
      'description' => 'required|min:2',
      'image' => 'mimes:jpeg,jpg,png'
    ]);
  }
}

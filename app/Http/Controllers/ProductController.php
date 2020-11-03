<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'product_image' => 'image|max:2048|nullable'

        ]);


        $name = $request->input('name');
        $description = $request->input('description');
        $service = $request->input('service');
        $stock = $request->input('stock');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $image = $request->file('product_image');

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        if($service)
            $product->service = true;
        if($stock)
            $product->stock = true;
        if($discount)
            $product->discount = true;

        $product->price = $price;



        if($product->save()) {
            if($image) {
                $filename = $image->getClientOriginalName() . '_' . date('Y_m_d_H_i_s') . '.' . $image->getClientOriginalExtension();
                $path = 'images/products/' . $filename;
                $product->img_url = $path;
                if($product->save()) {
                    $image->move(public_path('images/products'), $filename);

                }

            }

        }

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product) {
            return view('product_details')->withProduct($product)->withTitle($product->name);

        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required:numeric',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'product_image' => 'image|max:2048|nullable'

        ]);




        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $service = $request->input('service');
        $stock = $request->input('stock');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $image = $request->file('product_image');



        $product = Product::find($id);
        if($product) {
            $product->name = $name;
            $product->description = $description;

            if($service)
                $product->service = true;
            else
                $product->service = false;

            if($stock)
                $product->stock = true;
            else
                $product->stock = false;

            if($discount)
                $product->discount = true;
            else
                $product->discount = false;

            $product->price = $price;



            if($product->save()) {
                if($image) {
                    if($product->img_url) {
                        @unlink($product->img_url);
                    }
                    $filename = $image->getClientOriginalName() . '_' . date('Y_m_d_H_i_s') . '.' . $image->getClientOriginalExtension();
                    $path = 'images/products/' . $filename;
                    $product->img_url = $path;
                    if($product->save()) {
                        $image->move(public_path('images/products'), $filename);

                    }

                }

            }
        }


        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product) {
                @unlink($product->img_url);
                $product->delete();

        }

        return redirect()->route('index');


    }
}

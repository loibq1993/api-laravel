<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\EditProduct;

class ProductController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $i=1;
        $products = Product::where('active',1)->orderBy('id','desc')->get();
//        return view('/product/index',compact('products','i'));
        return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(StoreProduct $request)
    {
        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imageName);

        $product = Product::create([
            'name' => $request->name,
            'image' => $imageName,
            'description' => $request->description,
            'quantity' => $request->quantity
        ]);

        return response()->json($product, 201);
//        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
//        return view('product/edit',compact('product'));
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProduct $request)
    {
        $product = Product::find($request->id);
        $imageName = $product->image;
//        $name = $product->name;
//        $description = $product->description;
//        $quantity = $product->quantity;

        if($request->image) {
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        }
        $product->name = $request->name;
        $product->image = $imageName;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->save();
//        return redirect('/product');
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->update([
            'active' => 0
        ]);
//        return redirect('/product');
        return response()->json(null, 200);
    }
}

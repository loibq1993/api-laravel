<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\EditProduct;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = $this->productService->getAll();
        $i = 1;    
        // return response()->json($product, 201);
        return view('product.backend.index', compact('products', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.backend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $data = $request->only([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'quantity' => $request->quantity
        ]);
        $product = $this->productService->store($data);
        
        // return response()->json($product, 201);
        return redirect('/product');
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
        $product = $this->productService->find($id);

        return view('product.backend.edit',compact('product'));
        // return response()->json($product, 200);
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
        return redirect('/product');
        // return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect('/product');
        // return response()->json(null, 200);
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\ProductVariant;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //Products
        $products = Product::whereHas('productVariantPrice', function($price){
            //$price->with('productVariantTwo', 'productVariantTwo', 'productVariantThree');
            $price->whereHas('productVariantOne', function($variant){
                if (\request()->filled('variant')){
                    $variant->where('variant', \request()->get('variant'));
                }
            })
            ->orWhereHas('productVariantTwo', function($variant){
                if (\request()->filled('variant')){
                    $variant->where('variant', \request()->get('variant'));
                }
            })
            ->orWhereHas('productVariantThree', function($variant){
                if (\request()->filled('variant')){
                    $variant->where('variant', \request()->get('variant'));
                }
            });

        })
        ->whereHas('productVariantPrice', function ($price){

            if (\request()->filled('price_from')){
                $price->where('price', '>', \request()->get('price_from'));
            }

            if (\request()->filled('price_to')){
                $price->where('price', '<', \request()->get('price_to'));
            }
        });


        if ($request->filled('date')){
            $products->whereDate('created_at', Carbon::parse($request->get('date'))->format('Y-m-d H:i:s'));
        }

        if ($request->filled('title')){
            $products->where('title', 'LIKE',  '%'.$request->get('title').'%');
        }

        $products = $products->paginate(config('system.perPage'));

        //All variants;
        $variants = ProductVariant::groupBy('variant_id')->get();


        return view('products.index', compact('products', 'variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();

       /* $product = Product::with(['productVariantPrice' => function($price){

            $price->with(['productVariantOne' => function($variant){
                    $variant->with('variant');
            }])
            ->with(['productVariantTwo' =>function($variant){
                $variant->with('variant');
            }])
            ->with(['productVariantThree' => function($variant){
                $variant->with('variant');
            }]);
        }])
            ->where('id', $product->id)
            ->first();*/

        return view('products.edit', compact('variants', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

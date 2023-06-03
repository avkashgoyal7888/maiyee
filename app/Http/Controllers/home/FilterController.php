<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use DB;

class FilterController extends Controller
{
    public function filterByColorCat(Request $request)
    {
        $catid = $request->id;
        $productIds = Product::where('cat_id', $catid)->pluck('id');
        $selectedSizes = $request->input('selected_sizes');
        $products = Color::join("products","colors.product_id","=","products.id")->whereIn('colors.product_id', $productIds)->whereIn('color_category', $selectedSizes)
            ->select("colors.*","products.name as proname","products.mrp as mrps","products.discount as discounts","products.id as proid")->get();
        return response()->json($products);
    }

    public function filterBySizeCat(Request $request)
    {
        $catid = $request->id;
        $selectedSizes = $request->input('selected_sizes');
        $productIds = Product::where('cat_id', $catid)->pluck('id');
        $products = Size::join("products", "sizes.product_id", "=", "products.id")
            ->whereIn('sizes.product_id', $productIds)
            ->whereIn('sizes.size', $selectedSizes)
            ->select("sizes.*","products.name as proname","products.mrp as mrps","products.discount as discounts","products.image as images","products.id as proid")
        ->get();
        return response()->json($products);
    }

    public function filterByPriceCat(Request $request)
    {
        $catid = $request->id;
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        $products = Product::where('cat_id', $catid)->whereBetween('discount', [$minPrice, $maxPrice])->get();
        return response()->json($products);
    }

    public function filterByColorSub(Request $request)
    {
        $subid = $request->id;
        $productIds = Product::where('cat_id', $subid)->pluck('id');
        $selectedSizes = $request->input('selected_sizes');
        $products = Color::join("products","colors.product_id","=","products.id")->whereIn('colors.product_id', $productIds)->whereIn('color_category', $selectedSizes)
            ->select("colors.*","products.name as proname","products.mrp as mrps","products.discount as discounts","products.id as proid")->get();
        return response()->json($products);
    }

    public function filterBySizeSub(Request $request)
    {
        $subid = $request->id;
        $selectedSizes = $request->input('selected_sizes');
        $productIds = Product::where('cat_id', $subid)->pluck('id');
        $products = Size::join("products", "sizes.product_id", "=", "products.id")
            ->whereIn('sizes.product_id', $productIds)
            ->whereIn('sizes.size', $selectedSizes)
            ->select("sizes.*","products.name as proname","products.mrp as mrps","products.discount as discounts","products.image as images","products.id as proid")
        ->get();
        return response()->json($products);
    }

    public function filterByPriceSub(Request $request)
    {
        $subid = $request->id;
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        $products = Product::where('cat_id', $subid)->whereBetween('discount', [$minPrice, $maxPrice])->get();
        return response()->json($products);
    }
}

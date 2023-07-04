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

    public function filterByPriceCat(Request $request)
    {
        $catid = $request->id;
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $selectedSizes = $request->input('selected_sizes');
        $selectedColors = $request->input('selected_colors');
        $productIds = Product::where('cat_id', $catid)->pluck('id');
        $query = Size::join("products", "sizes.product_id", "=", "products.id")
        ->join("colors", "sizes.color_id", "=", "colors.id")
        ->whereIn('sizes.product_id', $productIds);
        if (!empty($selectedSizes)) {
            $query->whereIn('sizes.size', $selectedSizes);
        }
        if (!empty($selectedColors)) {
            $query->whereIn('colors.color_category', $selectedColors);
        }
        $query->whereBetween('products.discount', [$minPrice, $maxPrice]);
        $products = $query->select("sizes.*", "products.name as proname", "products.mrp as mrps", "products.discount as discounts", "colors.image as images", "products.id as proid","colors.code as colorcode")
        ->get();
        return response()->json($products);
    }

    public function filterByPriceSub(Request $request)
    {
        $catid = $request->id;
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $selectedSizes = $request->input('selected_sizes');
        $selectedColors = $request->input('selected_colors');
        $productIds = Product::where('sub_id', $catid)->pluck('id');
        $query = Size::join("products", "sizes.product_id", "=", "products.id")
        ->join("colors", "sizes.color_id", "=", "colors.id")
        ->whereIn('sizes.product_id', $productIds);
        if (!empty($selectedSizes)) {
            $query->whereIn('sizes.size', $selectedSizes);
        }
        if (!empty($selectedColors)) {
            $query->whereIn('colors.color_category', $selectedColors);
        }
        $query->whereBetween('products.discount', [$minPrice, $maxPrice]);
        $products = $query->select("sizes.*", "products.name as proname", "products.mrp as mrps", "products.discount as discounts", "colors.image as images", "products.id as proid","colors.code as colorcode")
        ->get();
        return response()->json($products);
    }
}

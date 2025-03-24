<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $size = $request->query('size') ? $request->query('size') : 12;
        $oColumn = "";
        $oOrder = "";
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');

        $f_genders = $request->query('genders') ? explode(',', $request->query('genders')) : [];

        $minPrice = $request->query('min') ? $request->query('min') : 1;
        $maxPrice = $request->query('max') ? $request->query('max') : 5000;

        switch ($order){
            case 1:
                $oColumn = 'created_at';
                $oOrder = 'DESC';
                break;
            case 2:
                $oColumn = 'created_at';
                $oOrder = 'ASC';
                break;
            case 3:
                $oColumn = 'sale_price';
                $oOrder = 'ASC';
                break;
            case 4:
                $oColumn = 'sale_price';
                $oOrder = 'DESC';
                break;
            default:
                $oColumn = 'id';
                $oOrder = 'DESC';
                break;
        }
        $brands = Brand::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        $products = Product::where(function ($query) use ($f_genders) {
                if (!empty($f_genders)) {
                    $query->whereIn('gender', $f_genders);
                }
            })
            ->where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "'=''");
            })
            ->where(function ($query) use ($f_categories) {
                $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "'=''");
            })
            ->where(function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('sale_price', [$minPrice, $maxPrice])->orWhereBetween('regular_price', [$minPrice, $maxPrice]);
            })
            ->orderBy($oColumn, $oOrder)
            ->paginate($size);

        $genderCounts = Product::select('gender', \DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender');


        return view('shop', compact('products', 'size', 'order', 'brands', 'f_brands', 'categories', 'f_categories', 'minPrice', 'maxPrice', 'genderCounts', 'f_genders'));
    }

    public function product_details($product_slug){
        $product = Product::where('slug', $product_slug)->first();
        $rProducts = Product::where('slug','<>',$product_slug)->inRandomOrder()->get()->take(8);
        return view('details', compact('product', 'rProducts'));
    }


}

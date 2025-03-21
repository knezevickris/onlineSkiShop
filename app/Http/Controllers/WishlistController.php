<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Product;

class WishlistController extends Controller
{
    public function add_to_wishlist(Request $request){
        $user = Auth::user();
        if (!$user->favoriteProducts()->where('product_id', $request->id)->exists()) {
            $user->favoriteProducts()->attach($request->id);
        }

        return redirect()->back()->with('success', 'Proizvod je dodat u omiljene!');
    }

    public function index(){
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $items = Auth::user()->favoriteProducts()->get();
        return view('wishlist', compact('items'));
    }

    public function remove_item($rowId){
        Auth::user()->favoriteProducts()->detach($rowId);
        return redirect()->back()->with('success', 'Proizvod je uklonjen iz omiljenih.');
    }

    public function empty_wishlist(){
        Auth::user()->favoriteProducts()->detach();
        return redirect()->back()->with('success', 'Wishlist je ispražnjen.');
    }

    public function move_to_cart($rowId){
        $product = Product::find($rowId);
        if ($product) {
            Cart::instance('cart')->add($product->id, $product->name, 1, $product->sale_price)->associate('App\Models\Product');
            Auth::user()->favoriteProducts()->detach($rowId);
        }
        return redirect()->back()->with('success', 'Proizvod je prebačen u korpu.');
    }
}

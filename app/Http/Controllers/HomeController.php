<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('status', 1)->get()->take(3);
        $categories = Category::orderBy('created_at')->get();
        $sProducts = Product::whereColumn('sale_price', '<>', 'regular_price')->inRandomOrder()->get()->take(8);
        $fProducts = Product::where('featured', 1)->inRandomOrder()->get()->take(8);
        return view('index', compact('slides', 'categories', 'sProducts', 'fProducts'));
    }

    public function contact(){
        return view ('contact');
    }

    public function contact_store(Request $request){
        $request->validate([
           'name'=>'required|max:100',
            'phone'=>'required|numeric',
            'email'=>'required',
            'comment'=>'required'
        ]);

        $contact = new Contact();
        $contact-> name = $request->name;
        $contact-> phone = $request->phone;
        $contact-> email = $request->email;
        $contact-> comment = $request->comment;
        $contact->save();

        return redirect()->back()->with('success', "Vaša poruka je uspješno poslata.");
    }

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);

        return response()->json($results);
    }

    public function about_us(){
        return view('about');
    }

    public function privacy_policy(){
        return view('privacy-policy');
    }

    public function terms_and_conditions(){
        return view('terms-and-conditions');
    }

    public function shop_by_gender($gender){
        $categories = Category::all();
        $f_categories = Category::all();
        $brands = Brand::all();
        $f_brands = Brand::all();
        $minPrice = "0";
        $maxPrice = "9999";
        $size = "12";
        $order = "-1";

        $f_genders = ['A', 'B', 'C'];

        if ($gender == 'F') {
            $products = Product::whereIn('gender', ['F', 'U'])->paginate(10);
        } elseif ($gender == 'M') {
            $products = Product::whereIn('gender', ['M', 'U'])->paginate(10);
        } else {
            $products = Product::paginate(10);
        }
        return view('shop', compact('products', 'categories', 'f_categories', 'brands', 'f_brands', 'minPrice', 'maxPrice', 'size', 'order', 'f_genders'));
    }
}

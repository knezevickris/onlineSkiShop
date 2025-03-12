<?php

namespace App\Http\Controllers;

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
        $categories = Category::orderBy('name')->get();
        $sProducts = Product::whereColumn('sale_price', '<>', 'regular_price')->inRandomOrder()->get()->take(8);
        $fProducts = Product::where('featured', 1)->get()->take(8);
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
}

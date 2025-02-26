<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function brands(){
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    //CRUD FUNKCIJE ZA BRENDOVE
    public function add_brand(){
        return view('admin.brand-add');
    }


    public function brand_store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;

        // Generisanje unikatanog slug-a
        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $brand->slug = $count ? "{$slug}-{$count}" : $slug;

        // Obrada slike
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this ->generateBrandThumbnailsImage($image, $fileName);
            $image->storeAs('brands', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $brand->image = $fileName;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Novi brend je uspješno dodat.');
    }

    //POMOCNA FUNKCIJA ZA GENERISANJE SLICICE
    public  function generateBrandThumbnailsImage($image, $imageName){
        $destinationPath = public_path('uploads/brands');
        $img = Image::read($image->path());
        $img -> cover(124, 124, "top");
        $img -> resize(124, 124, function ($constraint){
           $constraint -> aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function brand_edit($id){
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function brand_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = Brand::find($request->id);
        $brand->name = $request->name;

        // Generisanje unikatanog slug-a
        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $brand->slug = $count ? "{$slug}-{$count}" : $slug;

        // Obrada slike
        if ($request->hasFile('image')) {
            if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this ->generateBrandThumbnailsImage($image, $fileName);
            $image->storeAs('brands', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $brand->image = $fileName;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Podaci o brendu su uspješno izmjenjeni.');

    }

    public function brand_delete($id){
        $brand = Brand::find($id);
        if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
            File::delete(public_path('uploads/brands').'/'.$brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status','Brend je uspješno izbrisan.');
    }

    //CRUD FUNKCIJE ZA KATEGORIJE ARTIKALA

    public function categories(){
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function category_add(){
        return view('admin.category-add');
    }

    public function category_store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = new Category();
        $category->name = $request->name;

        // Generisanje unikatanog slug-a
        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $category->slug = $count ? "{$slug}-{$count}" : $slug;

        // Obrada slike
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this ->generateCategoryThumbnailsImage($image, $fileName);
            $image->storeAs('brands', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $category->image = $fileName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Nova kategorija je uspješno dodata.');
    }

    public  function generateCategoryThumbnailsImage($image, $imageName){
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img -> cover(124, 124, "top");
        $img -> resize(124, 124, function ($constraint){
            $constraint -> aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;

        // Generisanje unikatanog slug-a
        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $category->slug = $count ? "{$slug}-{$count}" : $slug;

        // Obrada slike
        if ($request->hasFile('image')) {
            if(File::exists(public_path('uploads/categories').'/'.$category->image)){
                File::delete(public_path('uploads/categories').'/'.$category->image);
            }
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this ->generateCategoryThumbnailsImage($image, $fileName);
            $image->storeAs('categories', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $category->image = $fileName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Podaci o kategoriji su uspješno izmjenjeni.');

    }

    public function category_delete($id){
        $category = Category::find($id);
        if(File::exists(public_path('uploads/categories').'/'.$category->image)){
            File::delete(public_path('uploads/categories').'/'.$category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status','Kategorija je uspješno obrisana');
    }

    //CRUD OPERACIJE ZA RAD SA ARTIKLIMA

    public function products(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function product_add(){
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function product_store(Request $request){
        $request -> validate([
           'name' => 'required',
           'slug' => 'required|unique:products,slug',
           'short_description' => 'required',
            'description' => 'required',
            'regular_price'=> 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required',
            'image'=>'required|mimes:png, jpg,jpeg|max:2048',
            'category_id'=>'required',
            'brand_id'=>'required'
        ]);

        $product = new Product();
        $product -> name = $request->name;

        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $product->slug = $count ? "{$slug}-{$count}" : $slug;

        $product -> short_description = $request->short_description;
        $product -> description = $request->description;
        $product -> regular_price = $request->regular_price;
        $product -> sale_price = $request->sale_price;
        $product -> SKU = $request->SKU;
        $product -> stock_status = $request->stock_status;
        $product -> featured = $request->featured;
        $product -> quantity = $request->quantity;
        $product -> category_id = $request->category_id;
        $product -> brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this -> generateProductThumbnail($image, $imageName);
            $product->image = $imageName;
        }

        $galleryArray = array();
        $galleryImages = "";
        $counter = 1;
        if($request->hasFile('images')){
            $allowedFileExtensions = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');
            foreach ($files as $file){
                $gExtension = $file -> getClientOriginalExtension();
                $gCheck = in_array($gExtension,@$allowedFileExtensions);
                if($gCheck){
                    $gFileName = $current_timestamp.'-'.$counter.'.'.$gExtension;
                    $this->generateProductThumbnail($file, $gFileName);
                    array_push($galleryArray, $gFileName);
                    $counter++;
                }
            }
            $galleryImages = implode(',',$galleryArray);
            //implode funkcija konvertuje array u string razdvojen zarezima
        }
        $product ->images = $galleryImages;

        $product->save();
        return redirect()->route('admin.products')->with('status', 'Artikal je uspješno sačuvan.');
    }

    public function generateProductThumbnail($image, $imageName){
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        $img = Image::read($image->path());

        $img -> cover(540, 689, "top");
        $img -> resize(540, 689, function ($constraint){
            $constraint -> aspectRatio();
        })->save($destinationPath.'/'.$imageName);

        $img -> resize(140, 104, function ($constraint){
            $constraint -> aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);
    }

    public function product_edit($id){
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories','brands'));
    }

    public function product_update(Request $request){
        $request -> validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price'=> 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required',
            'image'=>'mimes:png, jpg,jpeg|max:2048',
            'category_id'=>'required',
            'brand_id'=>'required'
        ]);

        $product = Product::find($request->id);
        $product -> name = $request->name;
        $slug = Str::slug($request->name);
        $count = Brand::where('slug', 'LIKE', "$slug%")->count();
        $product->slug = $count ? "{$slug}-{$count}" : $slug;
        $product -> short_description = $request->short_description;
        $product -> description = $request->description;
        $product -> regular_price = $request->regular_price;
        $product -> sale_price = $request->sale_price;
        $product -> SKU = $request->SKU;
        $product -> stock_status = $request->stock_status;
        $product -> featured = $request->featured;
        $product -> quantity = $request->quantity;
        $product -> category_id = $request->category_id;
        $product -> brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request->hasFile('image')){
            //prvo obrise staru sliku i njenu slicicu pa onda doda novu
            if(File::exists(public_path('uploads/products').'/'.$product->image)){
                File::delete(public_path('uploads/products').'/'.$product->image);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this -> generateProductThumbnail($image, $imageName);
            $product->image = $imageName;
        }

        $galleryArray = array();
        $galleryImages = "";
        $counter = 1;
        if($request->hasFile('images')){
            foreach(explode(',' , $product->images) as $oFile) {
                if (File::exists(public_path('uploads/products') . '/' . $oFile)) {
                    File::delete(public_path('uploads/products') . '/' . $oFile);
                }
                if (File::exists(public_path('uploads/products/thumbnails') . '/' . $oFile)) {
                    File::delete(public_path('uploads/products/thumbnails') . '/' . $oFile);
                }
            }
            $allowedFileExtensions = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');
            foreach ($files as $file){
                $gExtension = $file -> getClientOriginalExtension();
                $gCheck = in_array($gExtension,@$allowedFileExtensions);
                if($gCheck){
                    $gFileName = $current_timestamp.'-'.$counter.'.'.$gExtension;
                    $this->generateProductThumbnail($file, $gFileName);
                    array_push($galleryArray, $gFileName);
                    $counter++;
                }
            }
            $galleryImages = implode(',',$galleryArray);
            $product ->images = $galleryImages;
        }


        $product->save();
        return redirect()->route('admin.products')->with('status', 'Podaci o artiklu su uspješno izmjenjeni.');
    }

    public function product_delete($id){
        $product = Product::find($id);
        //pobrisemo prvo slike
        if (File::exists(public_path('uploads/products') . '/' . $product->image)) {
            File::delete(public_path('uploads/products') . '/' . $product->image);
        }
        if (File::exists(public_path('uploads/products/thumbnails') . '/' . $product->image)) {
            File::delete(public_path('uploads/products/thumbnails') . '/' . $product->image);
        }
        foreach(explode(',' , $product->images) as $oFile) {
            if (File::exists(public_path('uploads/products') . '/' . $oFile)) {
                File::delete(public_path('uploads/products') . '/' . $oFile);
            }
            if (File::exists(public_path('uploads/products/thumbnails') . '/' . $oFile)) {
                File::delete(public_path('uploads/products/thumbnails') . '/' . $oFile);
            }
        }

        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Artikal je uspješno izbrisan.');
    }

    //CRUD SA KUPONIMA
    public function coupons(){
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }

    public function coupon_add(){
        return view('admin.coupon-add');
    }

    public function coupon_store(Request $request){
        $request->validate(
            [
                'code'=>'required',
                'type'=>'required',
                'value'=>'required|numeric',
                'cart_value'=>'required|numeric',
                'expiry_date'=>'required|date',
            ]
        );

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('status','Novi kupon je uspješno dodat.');
    }

    public function coupon_edit($id){
        $coupon = Coupon::find($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function coupon_update(Request $request){
        $request->validate(
            [
                'code'=>'required',
                'type'=>'required',
                'value'=>'required|numeric',
                'cart_value'=>'required|numeric',
                'expiry_date'=>'required|date',
            ]
        );

        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('status','Detalji kupona su uspješno izmjenjeni.');
    }

    public function coupon_delete($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', 'Kupon je uspješno izbrisan.');
    }



}

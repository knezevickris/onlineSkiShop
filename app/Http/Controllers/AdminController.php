<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class AdminController extends Controller
{
    public function index(){
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(5);
        $dashboardDatas = DB::select("Select sum(total) As TotalAmount,
                                             sum(if(status='ordered', total, 0)) As TotalOrderedAmount,
                                             sum(if(status='delivered', total, 0)) As TotalDeliveredAmount,
                                             sum(if(status='canceled', total, 0)) As TotalCanceledAmount,
                                             Count(*) As Total,
                                             sum(if(status='ordered', 1, 0)) As TotalOrdered,
                                             sum(if(status='delivered', 1, 0)) As TotalDelivered,
                                             sum(if(status='canceled', 1, 0)) As TotalCanceled
                                             From Orders");

        $monthlyDatas = DB::select("SELECT
                                            M.id AS MonthNo,
                                            M.name AS MonthName,
                                            IFNULL(D.TotalAmount, 0) AS TotalAmount,
                                            IFNULL(D.TotalOrderedAmount, 0) AS TotalOrderedAmount,
                                            IFNULL(D.TotalDeliveredAmount, 0) AS TotalDeliveredAmount,
                                            IFNULL(D.TotalCanceledAmount, 0) AS TotalCanceledAmount
                                        FROM month_names M
                                        LEFT JOIN (
                                            SELECT
                                                MONTH(created_at) AS MonthNo,
                                                SUM(total) AS TotalAmount,
                                                SUM(IF(status='ordered', total, 0)) AS TotalOrderedAmount,
                                                SUM(IF(status='delivered', total, 0)) AS TotalDeliveredAmount,
                                                SUM(IF(status='canceled', total, 0)) AS TotalCanceledAmount
                                            FROM orders
                                            WHERE YEAR(created_at) = YEAR(NOW())
                                            GROUP BY YEAR(created_at), MONTH(created_at)
                                        ) D ON D.MonthNo = M.id
                                        ORDER BY M.id;");

        $amountM = implode(',', collect($monthlyDatas)->pluck('TotalAmount')->toArray());
        $orderedAmountM = implode(',', collect($monthlyDatas)->pluck('TotalOrderedAmount')->toArray());
        $deliveredAmountM = implode(',', collect($monthlyDatas)->pluck('TotalDeliveredAmount')->toArray());
        $canceledAmountM = implode(',', collect($monthlyDatas)->pluck('TotalCanceledAmount')->toArray());

        $totalAmount = collect($monthlyDatas)->sum("TotalAmount");
        $totalOrderedAmount = collect($monthlyDatas)->sum("TotalOrderedAmount");
        $totalDeliveredAmount = collect($monthlyDatas)->sum("TotalDeliveredAmount");
        $totalCanceledAmount = collect($monthlyDatas)->sum("TotalCanceledAmount");

        return view('admin.index', compact('orders', 'dashboardDatas', 'amountM', 'orderedAmountM', 'deliveredAmountM', 'canceledAmountM', 'totalAmount', 'totalOrderedAmount', 'totalDeliveredAmount', 'totalCanceledAmount'));
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
            $this->generateThumbnailImage($image, $fileName, 124, 124, 'brands');
//            $this ->generateBrandThumbnailsImage($image, $fileName);
            $image->storeAs('brands', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $brand->image = $fileName;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Novi brend je uspješno dodat.');
    }

    //POMOCNA FUNKCIJA ZA GENERISANJE SLICICE

    public function generateThumbnailImage($image, $fileName, $width, $height, $folder)
    {
        $destinationPath = public_path("uploads/{$folder}");
        $img = Image::read($image->path());

        $img->cover($width, $height, "top");
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $fileName);
    }


//    public  function generateBrandThumbnailsImage($image, $imageName){
//        $destinationPath = public_path('uploads/brands');
//        $img = Image::read($image->path());
//        $img -> cover(124, 124, "top");
//        $img -> resize(124, 124, function ($constraint){
//           $constraint -> aspectRatio();
//        })->save($destinationPath.'/'.$imageName);
//    }

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
//            $this ->generateBrandThumbnailsImage($image, $fileName);
            $this->generateThumbnailImage($image, $fileName, 124, 124, 'brands');
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
//            $this ->generateCategoryThumbnailsImage($image, $fileName);
            $this->generateThumbnailImage($image, $fileName, 124, 124, 'categories');
            $image->storeAs('brands', $fileName, 'public'); // Čuva sliku u storage/app/public/brands
            $category->image = $fileName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Nova kategorija je uspješno dodata.');
    }

//    public  function generateCategoryThumbnailsImage($image, $imageName){
//        $destinationPath = public_path('uploads/categories');
//        $img = Image::read($image->path());
//        $img -> cover(124, 124, "top");
//        $img -> resize(124, 124, function ($constraint){
//            $constraint -> aspectRatio();
//        })->save($destinationPath.'/'.$imageName);
//    }

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
            $this->generateThumbnailImage($image, $fileName, 124, 124, 'categories');
//            $this ->generateCategoryThumbnailsImage($image, $fileName);
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
        return redirect()->route('admin.categories')->with('status','Kategorija je uspješno obrisana.');
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
        $product -> gender = $request ->gender;
        $product -> has_sizes = $request->has_sizes;

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
        $product -> gender = $request ->gender;
        $product -> has_sizes = $request->has_sizes;

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

    //PRIKAZ NARUDZBI
    public function orders(){
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.orders', compact('orders'));
    }

    public function order_details($order_id){
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();

        return view('admin.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function update_order_status(Request $request){
        $order = Order::find($request->order_id);
        $order -> status = $request -> order_status;

        if($request->order_status == 'delivered'){
            $order->delivered_date = Carbon::now();
        }
        elseif($request->order_status == 'canceled'){
            $order->canceled_date = Carbon::now();
        }

        $order->save();

        if($request->order_status = 'delivered'){
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = 'approved';
            $transaction->save();
        }

        return back()->with("status", "Status narudžbe uspješno izmjenjen.");
    }

    //CRUD OPERACIJE SA PROMOCIJAMA
    public function slides(){
        $slides = Slide::orderBy('id', 'DESC')->paginate(12);
        return view('admin.slides', compact('slides'));
    }

    public function slide_add(){
        return view('admin.slide-add');
    }

    public function slide_store(Request $request){
        $request->validate([
           'tagline'=>'required',
           'title'=>'required',
           'subtitle'=>'required',
           'link'=>'required',
           'status'=>'required',
           'image'=>'required|mimes:png,jpeg,jpg|max:2048'
        ]);

        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this->generateThumbnailImage($image, $fileName, 400, 690, 'slides');
            $image->storeAs('slides', $fileName, 'public');
            $slide->image = $fileName;
        }

        $slide -> save();
        return redirect()->route('admin.slides')->with('status', "Promocija je uspješno sačuvana.");
    }

//    public function generateSlideThumbnailsImage($image, $fileName){
//        $destinationPath = public_path('uploads/slides');
//        $img = Image::read($image->path());
//        $img -> cover(400, 690, "top");
//        $img -> resize(400, 690, function ($constraint){
//            $constraint -> aspectRatio();
//        })->save($destinationPath.'/'.$fileName);
//    }

    public function slide_edit($slide_id){
        $slide = Slide::find($slide_id);
        return view('admin.slide-edit', compact('slide'));
    }

    public function slide_update(Request $request){
        $request->validate([
            'tagline'=>'required',
            'title'=>'required',
            'subtitle'=>'required',
            'link'=>'required',
            'status'=>'required',
            'image'=>'mimes:png,jpeg,jpg|max:2048'
        ]);

        $slide = Slide::find($request->id);

        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image')) {
            if(File::exists(public_path('uploads/slides').'/'.$request->image)){
                File::delete(public_path('uploads/slides').'/'.$request->image);
            }
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $fileName = Carbon::now()->timestamp . '.' . $fileExtension;
            $this->generateThumbnailImage($image, $fileName, 400, 690, 'slides');
//            $this ->generateSlideThumbnailsImage($image, $fileName);
            $image->storeAs('slides', $fileName, 'public');
            $slide->image = $fileName;
        }

        $slide -> save();
        return redirect()->route('admin.slides')->with('status', "Podaci o promociji su uspješno izmjenjeni.");
    }

    //UPRAVLJANJE KLIJENTSKIM PORUKAMA
    public function slide_delete($slide_id){
        $slide = Slide::find($slide_id);

        if(File::exists(public_path('uploads/slides').'/'.$slide->image))
            File::delete(public_path('uploads/slides').'/'.$slide->image);

        $slide->delete();

        return redirect()->route('admin.slides')->with('status', 'Promocija je uspješno obrisana.');
    }

    public function contacts(){
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function contact_delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with('status', 'Poruka je uspješno obrisana.');
    }

    //PRETRAGA

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);

        return response()->json($results);
    }


}



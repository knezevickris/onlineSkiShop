<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }


    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price, ['size' => $request->size ?? ''])->associate('\App\Models\Product');
        return redirect()->back();
    }

    public function increase_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty+1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function decrease_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_item($rowId){
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart(){
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon(Request $request){
        $coupon_code = $request->coupon_code;
        if(isset($coupon_code)){
           $coupon = Coupon::where('code', $coupon_code)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '>=',(float)Cart::instance('cart')->subtotal())->first();

            if(!$coupon)
                return redirect()->back()->with('error', 'Uneseni kupon ne postoji u bazi podataka.');
            else
                Session::put('coupon', [
                    'code'=>$coupon->code,
                    'type'=>$coupon->type,
                    'value'=>$coupon->value,
                    'cart_value'=>$coupon->cart_value
                ]);
            $this -> calculateDiscount();
            return redirect()->back()->with('success', 'Kupon je uspješno aktiviran.');
        }
        else{
            return redirect()->back()->with('error', 'Uneseni kupon uopšte ne postoji.');
        }
    }

    public function calculateDiscount(){
        $discount = 0;
        $total = str_replace(',', '', Cart::instance('cart')->subtotal());

        if(Session::has('coupon')){
            if(Session::get('coupon')['type'] == 'fixed'){
                $discount = Session::get('coupon')['value'];
            }
            else{
                $couponValue = floatval(Session::get('coupon')['value']);
                $discount = $total * $couponValue /100;
            }
        }

        $totalAfterDiscount = $total- $discount;
        $taxAfterDiscount = $totalAfterDiscount*0.1452;
        $subtotalAfterDiscount = $totalAfterDiscount*0.8548;


        Session::put('discounts', [
           'discount' => number_format(floatval($discount), 2, '.', ''),
           'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
           'tax' => number_format($taxAfterDiscount, 2, '.', ''),
           'total' => number_format(floatval($totalAfterDiscount), 2, '.', '')
        ]);
    }

    public function remove_coupon(){
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success', "Kupon je ponisten.");
    }

    public function checkout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }

        return  view('checkout');
    }


    public function place_an_order(Request $request){

//         $request->validate([
//               'name'=>'required|max:250',
//                'address'=>'required',
//                'phone'=>'required|numeric',
//                'city'=>'required',
//                'country'=>'required',
//                'zip'=>'required|numeric|max:6',
//                'customer_note' => 'sometimes|string'
//          ]);

        if($request->mode == 'card'){
            return redirect()->back()->with('error', 'Trenutno nije moguće izvršiti plaćanje karticom. Molimo odaberite drugi način plaćanja.');
        }
        elseif($request->mode == 'paypal'){
            return redirect()->back()->with('error', 'Trenutno nije moguće izvršiti plaćanje putem PayPal-a. Molimo odaberite drugi način plaćanja.');
        }

        $userId = Auth::user()->id;
        $address = new Address();

        $address->name = $request->name;
        $address->address = $request->address;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->zip = $request->zip;
        $address->user_id = $userId;
        $address->isdefault = true;

        $address->save();

        $this->setAmountForCheckout();

        $subtotal = str_replace(',', '', Session::get('checkout')['subtotal']);
        $tax = str_replace(',', '', Session::get('checkout')['tax']);
        $total = str_replace(',', '', Session::get('checkout')['total']);

        $subtotal = number_format((float)$subtotal, 2, '.', '');
        $tax = number_format((float)$tax, 2, '.', '');
        $total = number_format((float)$total, 2, '.', '');

        $order = new Order();

        $order->user_id = $userId;
        $order->subtotal = $subtotal;
        $order->tax = $tax;
        $order->total = $total;
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->email = $request->email;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->country = $address->country;
        $order->zip = $address->zip;
        $order->customer_note = $request->customer_note;

        if (Session::has('coupon')) {
            $order->coupon_code = Session::get('coupon')['code'];
            $order->discount = Session::get('checkout')['discount'];
        }

        $order->save();

        foreach (Cart::instance('cart')->content() as $item){
            $product = Product::find($item->id);

            if ($product->quantity < $item->qty) {
                return redirect()->back()->with('error', 'Nema dovoljno proizvoda na stanju!');
            }

            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->size = $product->size;
            $orderItem->save();

            $product->quantity -= $item->qty;
            $product->save();
        }

        if($request->mode == 'cod') {
                $transaction = new Transaction();
                $transaction->order_id = $order->id;
                $transaction->user_id = $userId;
                $transaction->mode = $request->mode;
                $transaction->status = "pending";
                $transaction->save();
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discount');
        Session::forget('discounts');
        Session::put('order_id', $order->id);

        return redirect()->route('cart.order.confirmation');
    }

    public function setAmountForCheckout(){
        $total = Cart::instance('cart')->subtotal();
        $pdv = $total * 0.1452;
        $subtotal = $total * 0.8548;


        if(!Cart::instance('cart')->content()->count() > 0){
            Session::forget('checkout');
            return;
        }

        if(Session::has('coupon')){
            Session::put('checkout', [
               'discount' => Session::get('discounts')['discount'],
               'subtotal' => Session::get('discounts')['subtotal'],
               'tax' => Session::get('discounts')['tax'],
               'total' => Session::get('discounts')['total'],
            ]);
        }

        else{
            Session::put('checkout', [
                'discount' => 0,
                'subtotal'=> $subtotal,
                'tax' => $pdv,
                'total' => $total
            ]);
        }
    }


    public function order_confirmation(){
        if(Session::has('order_id')){
            $order = Order::find(Session::get('order_id'));
            return view('order-confirmation', compact('order'));
        }
        else
            return redirect()->route('cart.index');
    }
}

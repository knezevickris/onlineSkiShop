@extends('layouts.app')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Isporuka i naplata</h2>
            <div class="checkout-steps">
                <a href="{{route('cart.index')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
            <span>Korpa</span>
            <em>Upravljajte svojim artiklima u korpi</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span>Isporuka i naplata</span>
            <em>Upravljajte detaljima isporuke</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
            <span>Potvrda narudžbe</span>
            <em>Pregledajte narudžbu i račun</em>
          </span>
                </a>
            </div>
            <form name="checkout-form" action="{{route('cart.place.an.order')}}" method="POST" onsubmit="console.log('Form submitted!')">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>DETALJI ISPORUKE</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if($address)
                            <div class="row">
                               <div class="col-md-12">
                                   <div class="my-account__address-list">
                                       <div class="my-account__address-list-item">
                                           <div class="my-account__address-item_details">
                                                <p>{{$address->name}}</p>
                                                <p>{{$address->address}}</p>
                                                <p>{{$address->city}}, {{$address->country}}</p>
                                                <p>{{$address->zip}}</p>
                                           <br/>
                                               <p>{{$address->phone}}</p>
                                               <p>{{$address->email}}</p>
                                           </div>
                                        </div>
                                   </div>
                               </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name" required="" value="{{old('name')}}">
                                        <label for="name" style="color: black">Ime i prezime *</label>
                                        @error('name')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="email" required="" value="{{old('email')}}">
                                        <label style="color: black" for="email">Email adresa *</label>
                                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" required=""  value="{{old('phone')}}">
                                        <label style="color: black" for="phone">Broj telefona *</label>
                                        @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="country" required=""  value="{{old('country')}}">
                                        <label style="color: black" for="country">Država *</label>
                                        @error('state')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="city" required=""  value="{{old('city')}}">
                                        <label style="color: black" for="city">Grad *</label>
                                        @error('city')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" required=""  value="{{old('address')}}">
                                        <label style="color: black" for="address">Adresa *</label>
                                        @error('address')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="zip" required=""  value="{{old('zip')}}">
                                        <label style="color: black" for="zip">Poštanski broj *</label>
                                        @error('zip')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="customer_note" required="">
                                        <label style="color: black" for="coustomer_note">Detalji </label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Vaša narudžba</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                    <tr>
                                        <th>Artikli</th>
                                        <th align="right">Troškovi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::instance('cart') as $item)
                                            <tr>
                                                <td>
                                                    {{$item->name}} x {{$item->qty}}
                                                </td>
                                                <td align="right">
                                                    {{$item->subtotal}} KM
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if(Session::has('discounts'))
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>Cijena</th>
                                                <td align="right"> {{Cart::instance('cart')->subtotal()}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>Popust {{Session::get('coupon')['code']}}</th>
                                                <td align="right">{{Session::get('discounts')['discount']}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>Cijena nakon popusta</th>
                                                <td align="right">{{Session::get('discounts')['subtotal']}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>Dostava</th>
                                                <td align="right">0.00 KM</td>
                                            </tr>
                                            <tr>
                                                <th>PDV</th>
                                                <td align="right">{{Session::get('discounts')['tax']}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>Ukupno</th>
                                                <td align="right">{{Session::get('discounts')['total']}} KM</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="checkout-totals">
                                        <tbody>
                                        <tr>
                                            <th>Cijena</th>
                                            <td align="right">{{Cart::instance('cart')->subtotal()}} KM</td>
                                        </tr>
                                        <tr>
                                            <th>Dostava</th>
                                            <td align="right">0.00 KM</td>
                                        </tr>
                                        <tr>
                                            <th>PDV</th>
                                            <td align="right">{{Cart::instance('cart')->tax()}} KM</td>
                                        </tr>
                                        <tr>
                                            <th>Ukupno</th>
                                            <td align="right">{{Cart::instance('cart')->total()}} KM</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode1" value="card">
                                    <label class="form-check-label" for="mode1">
                                        Plaćanje debitnom ili kreditnom karticom
                                        <p class="option-detail">
                                        </p>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="paypal">
                                    <label class="form-check-label" for="mode2">
                                        Paypal
                                        <p class="option-detail">
                                        </p>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode3" value="cod">
                                    <label class="form-check-label" for="mode3">
                                        Plaćanje kešom po preuzimanju
                                        <p class="option-detail">
                                        </p>
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Vaši lični podaci će biti korišćeni za obradu vaše porudžbine, podržavajući vaše iskustvo tokom upotrebe web sajtai za druge svrhe opisane u našoj  <a href="terms.html" target="_blank">politici privatnosti</a>.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-checkout">Naruči</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection


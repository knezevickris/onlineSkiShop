@extends('layouts.app')
@section('content')
    <style>
        .text-success{
            color: #278c04 !important;
        }
        .text-danger{
            color: #d61808 !important;
        }
    </style>

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Korpa</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
            <span>Korpa</span>
                        <em>Provjerite listu svojih artikala</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span>Dostava i plaćanje</span>
                        <em>Upravljajte detaljima isporuke</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
            <span>Pregled i slanje narudžbe</span>
                         <em>Pregledajte narudžbu i račun</em>
          </span>
                </a>
            </div>
            <div class="shopping-cart">
                @if($items->count()>0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Artikal</th>
                            <th></th>
                            <th>Cijena</th>
                            <th>Količina</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{asset('uploads/products/thumbnails')}}/{{$item->model->image}}" width="120" height="120" alt="{{$item->name}}" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{$item->name}}</h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <!--<li>Color: Yellow</li>
                                        <li>Size: L</li>-->
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">{{$item->price}} KM</span>
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{$item->qty}}" min="1" class="qty-control__number text-center">
                                    <form method="POST" action="{{route('cart.qty.decrease', ['rowId'=>$item->rowId])}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="qty-control__reduce">-</div>
                                    </form>
                                    <form method="POST" action="{{route('cart.qty.increase', ['rowId'=>$item->rowId])}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="qty-control__increase">+</div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">{{$item->subtotal}} KM</span>
                            </td>
                            <td>
                                <form method="post" action="{{route('cart.item.remove', ['rowId'=>$item->rowId])}}">
                                    @csrf
                                    @method("DELETE")
                                <a href="javascript:void(0)" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                    </svg>
                                </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">
                        @if(!Session::has('coupon'))
                            <form action="{{route('cart.coupon.apply')}}" method="post" class="position-relative bg-body">
                                @csrf
                                <input class="form-control" value="" type="text" name="coupon_code" placeholder="kod za popust">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="Iskoristi kupon">
                            </form>
                        @else
                            <form action="{{route('cart.coupon.remove')}}" method="post" class="position-relative bg-body">
                                @csrf
                                @method('DELETE')
                                <input class="form-control"  type="text"  value="@if(Session::has('coupon')) {{Session::get('coupon')['code']}} prihvacen! @endif" name="coupon_code" placeholder="kod za popust">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="Ukloni kupon">
                            </form>
                        @endif
                        <form action="{{route('cart.empty')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light">Isprazni korpu</button>
                        </form>
                    </div>
                    <div>
                        @if(Session::has('success'))
                            <p class="text-success"></p>
                            {{Session::get('success')}}
                        @elseif(Session::has('error'))
                            <p class="text-danger"></p>
                            {{Session::get('error')}}
                        @endif
                    </div>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Račun</h3>
                            @if(Session::has('discounts'))
                                <table class="cart-totals">
                                    <tbody>
                                    <tr>
                                        <th>Iznos bez popusta</th>
                                        <td class="text-right">{{Cart::instance('cart')->subtotal()}} KM</td>
                                    </tr>
                                    <tr>
                                        <th>Popust {{ optional(Session::get('coupon'))['code'] ?? '' }}</th>
                                        <td class="text-right">{{Session::get('discounts')['discount']}} KM</td>
                                    </tr>
                                    <tr>
                                        <th>Iznos bez PDV-a</th>
                                        <td class="text-right">{{Session::get('discounts')['subtotal']}} KM</td>
                                    </tr>
                                    <tr>
                                        <th>PDV</th>
                                        <td class="text-right">{{Session::get('discounts')['tax']}} KM</td>
                                    </tr>
                                    <tr>
                                        <th>Dostava</th>
                                        <td class="text-right">0.00 KM</td>
                                    </tr>
                                    <tr>
                                        <th>Ukupno</th>
                                        <td class="text-right">{{Session::get('discounts')['total']}} KM</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="cart-totals">
                                    <tbody>
                                    <tr>
                                        <th>Iznos bez PDV-a</th>
                                        <td class="text-right">{{ (float)Cart::instance('cart')->subtotal(2, '.', '') * (0.8548) }} KM</td>
                                    </tr>
                                    <tr>
                                        <th>PDV</th>
                                        <td class="text-right">{{ (float)Cart::instance('cart')->subtotal(2, '.', '') * 0.1452 }} KM</td>
                                    </tr>
                                    <tr>
                                        <th>Dostava</th>
                                        <td class="text-right">0.00 KM</td>
                                    </tr>
                                    <tr>
                                        <th>Ukupno</th>
                                        <td class="text-right">{{Cart::instance('cart')->subtotal()}} KM</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{route('cart.checkout')}}" class="btn btn-primary btn-checkout">Sljedeći korak</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center pt-5 bp-5">
                            <p>Vaša korpa je trenutno prazna.</p>
                            <a href="{{route('shop.index')}}" class="btn btn-info">Prodavnica</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function(){
            $(".qty-control__increase").on("click", function (){
                $(this).closest('form').submit();
            });

            $(".qty-control__reduce").on("click", function (){
                $(this).closest('form').submit();
            });

            $(".remove-cart").on("click", function (){
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush

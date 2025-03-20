@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Omiljeni artikli</h2>
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>
            <div class="shopping-cart">
                <div class="cart-table__wrapper">
{{--                    @if(Cart::instance('wishlist')->content()->count() > 0)--}}
                    @if($items->isEmpty())
                        <div class="text-center my-5">
                            <h4 class="text-muted">Vaša lista želja je prazna.</h4>
                            <p class="text-secondary">Dodajte proizvode u omiljene i pronađite ih lako kasnije!</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary">Idi u prodavnicu</a>
                        </div>
                    @else
                        <table class="cart-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Naziv artikla</th>
                                <th>Cijena</th>
                                <th>Akcije</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <img loading="lazy" src="{{asset('uploads/products/thumbnails')}}/{{$item->image}}" width="120" height="120" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{$item -> name}}</h4>
                                                <!--
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>Color: Yellow</li>
                                                    <li>Size: L</li>
                                                </ul> -->
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">{{$item->sale_price}} KM</span>
                                        </td>
                                       <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <form method="POST" action="{{route('wishlist.move.to.cart', ['rowId'=>$item->id])}}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning">Dodaj u korpu</button>
                                                    </form>
                                                </div>
                                                <div class="col-6">
                                                    <form id="remove-item-{{$item->id}}" method="POST" action="{{route('wishlist.item.remove', ['rowId'=>$item->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0)" onclick="document.getElementById('remove-item-{{$item->id}}').submit();" class="remove-cart">
                                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                                <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                            </svg>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            <form method="POST" action="{{route('wishlist.items.clear')}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light">Isprazni listu</button>
                            </form>
                        </div>
                    @endif
                </div>
{{--                @else--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <p>Vaša lista omiljenih artikala je prazna!</p>--}}
{{--                            <a href="{{route('shop.index')}}" class="btn btn-info">Prodavnica</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>
        </section>
    </main>



@endsection

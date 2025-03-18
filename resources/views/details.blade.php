@extends('layouts.app')
@section('content')
    <style>
        .filled-heart{
            color:orangered;
        }
    </style>
    <main class="pt-90">
        <br><br>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-auto" src="{{asset('uploads/products')}}/{{$product->image}}" width="674" height="674" alt="{{$product->name}}" />
                                        <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{$product->image}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_zoom" />
                                            </svg>
                                        </a>
                                    </div>
                                    @foreach(explode(',',$product->images) as $gImage)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" src="{{asset('uploads/products')}}/{{$gImage}}" width="674" height="674" alt="" />
                                            <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{$gImage}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto" src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" width="104" height="104" alt="" /></div>
                                @foreach(explode(',', $product->images) as $gImage)
                                    <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto" src="{{asset('uploads/products/thumbnails')}}/{{$gImage}}" width="104" height="104" alt="" /></div>@endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="{{route('home.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Početak</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="{{route('shop.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Prodavnica</a>
                        </div><!-- /.breadcrumb -->
                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                            <a href="#" class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_md" />
                                </svg><span class="menu-link menu-link_us-s">Prethodni</span></a>
                            <a href="#" class="text-uppercase fw-medium"><span class="menu-link menu-link_us-s">Naredni</span><svg width="10" height="10" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md" />
                                </svg></a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name" style="color: darkblue">{{$product->name}}</h1>
                    <br><br>
                    <div class="product-single__price">
                        <span class="current-price">
                             @if($product->sale_price != $product->regular_price)
                                <s> {{$product->regular_price}} KM </s> {{$product->sale_price}} KM
                            @else
                                {{$product->regular_price}} KM
                            @endif
                        </span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{$product->short_description}}</p>
                    </div>
                    @if($product->quantity == 0)
                        <div class="alert alert-danger text-center fw-bold p-3" style="font-size: 1.5rem; border: 3px solid darkred; background-color: #ffcccc;">
                            Trenutno nije dostupno na stanju!
                        </div>
                    @else
                        @if(Cart::instance('cart')->content()->where('id', $product->id)->count()>0)
                            <a href="{{route('cart.index')}}" class="btn btn-warning mb-3">U korpi</a>
                        @else
                            <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                                @csrf
                                @method('POST')
                                <div class="product-single__addtocart">
                                    <div class="qty-control position-relative">
                                        <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                                        <div class="qty-control__reduce">-</div>
                                        <div class="qty-control__increase">+</div>
                                    </div><!-- .qty-control -->
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="name" value="{{$product->name}}">
                                    <input type="hidden" name="price" value="{{$product->sale_price == ''? $product->regular_price : $product->sale_price}}">
                                    <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Dodaj u korpu</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    <div class="product-single__addtolinks">
                        @if(Cart::instance('wishlist')->content()->where('id', $product -> id)->count() > 0)
                            <form id="frm-remove" method="POST" action="{{route('wishlist.item.remove', ['rowId'=>Cart::instance('wishlist')->content()->where('id', $product -> id)->first()->rowId])}}">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist filled-heart" onclick="document.getElementById('frm-remove').submit();"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_heart" />
                                </svg><span> Ukloni iz omiljenih artikala</span></a>
                            </form>
                        @else
                            <form method="POST" action="{{route('wishlist.add')}}" id="wishlist-form">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}" />
                                <input type="hidden" name="name" value="{{$product->name}}" />
                                <input type="hidden" name="price" value="{{$product->sale_price != $product -> regular_price ? $product->sale_price : $product -> regular_price}}" />
                                <input type="hidden" name="quantity" value="1" />
                                <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist" onclick="document.getElementById('wishlist-form').submit()"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg><span> Dodaj u omiljene artikle</span></a>
                            </form>
                        @endif
                        <script src="js/details-disclosure.html" defer="defer"></script>
                        <script src="js/share.html" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>Bar kod:</label>
                            <span>{{$product->SKU}}</span>
                        </div>
                        <div class="meta-item">
                            <label>Kategorija:</label>
                            <span>{{$product->category->name}}</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span>NA</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                           href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Opis</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                           href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                           aria-selected="false">Dodatne informacije</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                         aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            {{$product->description}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Weight</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="item">
                                <label class="h6">Dimensions</label>
                                <span>90 x 60 x 90 cm</span>
                            </div>
                            <div class="item">
                                <label class="h6">Size</label>
                                <span>XS, S, M, L, XL</span>
                            </div>
                            <div class="item">
                                <label class="h6">Color</label>
                                <span>Black, Orange, White</span>
                            </div>
                            <div class="item">
                                <label class="h6">Storage</label>
                                <span>Relaxed fit shirt-style dress with a rugged</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Slični <strong>artikli</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach($rProducts as $rProduct)
                            <div class="swiper-slide product-card">
                            <div class="pc__img-wrapper">
                                <a href="{{route('shop.product.details', ['product_slug'=>$rProduct->slug])}}">
                                    <img loading="lazy" src="{{asset('uploads/products')}}/{{$rProduct->image}}" width="330" height="400" alt="{{$rProduct->name}}" class="pc__img">
                                    @foreach(explode(',', $rProduct->images) as $gImage)
                                        <img loading="lazy" src="{{asset('uploads/products')}}/{{$gImage}}" width="330" height="400" alt="{{$rProduct->name}}" class="pc__img pc__img-second">
                                    @endforeach
                                </a>
                                @if(Cart::instance('cart')->content()->where('id', $rProduct->id)->count()>0)
                                    <a href="{{route('cart.index')}}" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning mb-3">U korpi</a>
                                @else
                                    <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$rProduct->id}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="name" value="{{$rProduct->name}}">
                                        <input type="hidden" name="price" value="{{$rProduct->sale_price == ''? $rProduct->regular_price : $rProduct->sale_price}}">
                                        <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" data-aside="cartDrawer" title="Add To Cart">Dodaj u korpu</button>
                                    </form>
                                @endif
                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category">{{$rProduct->category->name}}</p>
                                <h6 class="pc__title"><a href="{{route('shop.product.details', ['product_slug'=>$rProduct->slug])}}">{{@$rProduct->name}}</a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price">
                                        @if($rProduct->sale_price != $rProduct->regular_price )
                                            <s> {{$rProduct->regular_price}} KM </s> {{$rProduct->sale_price}}
                                        @else
                                            {{$rProduct->regular_price}}
                                        @endif
                                    </span>
                                </div>
                                <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                        title="Add To Wishlist">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>


@endsection

@extends('layouts.app')
@section('content')
    <style>
        .filled-heart{
            color: orangered;
        }
    </style>

    <main class="pt-90">
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0" >Filteri</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>
                <div class="accordion" id="gender-filters">
                    <div class="accordion-item mb-4 pb-3" style="background-color: #FFFFFF; border: none" >
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-filter-brand" aria-expanded="true" aria-controls="accordion-filter-brand" style="background-color: #FFFFFF;">
                                Pol
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="search-field multi-select accordion-body px-0 pb-0">
                                <ul class="list list-inline mb-0 brand-list">
                                    <li class="list-item">
                                            <span class="menu-link py-1">
                                                <input type="checkbox" name="genders" value="F" class="chk-brand"
                                                       @if(in_array('F', $f_genders)) checked="checked" @endif> Ženski
                                            </span>
                                        <span class="text-right float-end">{{ $genderCounts['F'] ?? 0 }}</span>
                                    </li>
                                    <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input type="checkbox" name="genders" value="M" class="chk-brand"
                                                           @if(in_array('M', $f_genders)) checked="checked" @endif> Muški
                                                </span>
                                        <span class="text-right float-end">{{ $genderCounts['M'] ?? 0 }}</span>
                                    </li>
                                    <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input type="checkbox" name="genders" value="U" class="chk-brand"
                                                           @if(in_array('U', $f_genders)) checked="checked" @endif> Unisex
                                                </span>
                                        <span class="text-right float-end">{{ $genderCounts['U'] ?? 0 }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="categories-list">
                    <div class="accordion-item mb-4 pb-3" style="background-color: #FFFFFF; border: none">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1" style="background-color: #FFFFFF;">
                                Kategorije artikala
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list" >
                            <div class="accordion-body px-0 pb-0 pt-3 category-list">
                                <ul class="list list-inline mb-0">
                                    @foreach($categories as $category)
                                        <li class="list-item">
                                            <span class="menu-link py-1">
                                                <input type="checkbox" class="chk-category" name="categories" value="{{$category->id}}"
                                                @if(in_array($category->id, explode(',', $f_categories))) checked="checked" @endif>
                                                {{$category->name}}
                                            </span>
                                            <span class="text-right float-end">{{$category->products->count()}}</span>                                           </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="brand-filters">
                    <div class="accordion-item mb-4 pb-3" style="background-color: #FFFFFF; border: none" >
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-filter-brand" aria-expanded="true" aria-controls="accordion-filter-brand" style="background-color: #FFFFFF;">
                                Brendovi
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="search-field multi-select accordion-body px-0 pb-0">
                                <ul class="list list-inline mb-0 brand-list">
                                    @foreach($brands as $brand)
                                        <li class="list-item">
                                            <span class="menu-link py-1">
                                                <input type="checkbox" name="brands" value="{{$brand->id}}" class="chk-brand"
                                                @if(in_array($brand->id,explode(',',$f_brands))) checked="checked"@endif>
                                                {{$brand->name}}
                                            </span>
                                            <span class="text-right float-end">
                                                 {{$brand->products->count()}}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="price-filters">
                    <div class="accordion-item mb-4" style="background-color: #FFFFFF; border: none">
                        <h5 class="accordion-header mb-2" id="accordion-heading-price">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price" style="background-color: #FFFFFF;">
                                Cijene
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
                             aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                            <input class="price-range-slider" type="text" name="price_range" value="" data-slider-min="1"
                                   data-slider-max="5000" data-slider-step="200" data-slider-value="[{{$minPrice}}, {{$maxPrice}}]" data-currency="BAM" />
                            <div class="price-range__info d-flex align-items-center mt-2">
                                <div class="me-auto">
                                    <span class="text-secondary">Najniža: </span>
                                    <span class="price-range__min">1 KM</span>
                                </div>
                                <div>
                                    <span class="text-secondary">Najviša: </span>
                                    <span class="price-range__max">5000 KM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('shop.index') }}" class="btn btn-secondary">Resetuj filtere</a>
                </div>
            </div>

            <div class="shop-list flex-grow-1">
                <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div class="slide-split_text position-relative d-flex align-items-center"
                                     style="background-color: #f5e6e0;">
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2 class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            <br /><strong>Sezonsko sniženje</strong></h2>
                                        <h6 class="mb-0 animate animate_fade animate_btt animate_delay-5">Iskoristi popuste do -40% na mnoge brendove iz ovosezonske kolekcije!</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy" src="{{asset('uploads/photos/pic1.jpeg')}}" width="630" height="450" alt="" class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div class="slide-split_text position-relative d-flex align-items-center" style="background-color: #f5e6e0;">
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2 class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            <br /><strong>Cijene padaju ali vi sa skija nećete</strong></h2>
                                        <h6 class="mb-0 animate animate_fade animate_btt animate_delay-5">Popust od -10% na sve modele Volkl skija.</h6>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy" src="{{asset('uploads/photos/pic2.png')}}" width="630" height="450" alt="" class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                <div class="slide-split_text position-relative d-flex align-items-center" style="background-color: #f5e6e0;">
                                    <div class="slideshow-text container p-3 p-xl-5">
                                        <h2 class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                            <br />Budite spremni za sve skijaške avanture</h2>
                                        <p class="mb-0 animate animate_fade animate_btt animate_delay-5"></p>
                                    </div>
                                </div>
                                <div class="slide-split_media position-relative">
                                    <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                        <img loading="lazy" src="{{asset('uploads/photos/pic3.png')}}" width="630" height="450" alt="" class="slideshow-bg__img object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container p-3 p-xl-5">
                        <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2"></div>
                    </div>
                </div>

                <div class="mb-3 pb-2 pb-xl-3"></div>

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{route('home.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Početna stranica</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="{{route('shop.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Prodavnica</a>
                    </div>
                    <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <span class="text-uppercase fw-medium me-2" style="color: darkblue;">Broj artikala:  </span>
                        <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Page size" id="pagesize" name="pagesize"  style="margin-right: 20px;">
                            <option value="12" {{$size == 12 ? 'selected':''}}>12</option>
                            <option value="24" {{$size == 24 ? 'selected':''}}>24</option>
                            <option value="48" {{$size == 48 ? 'selected':''}}>48</option>
                            <option value="96" {{$size == 96 ? 'selected':''}}>96</option>
                        </select>
                        <span class="text-uppercase fw-medium me-2 " style="color: darkblue;">Sortiraj:  </span>
                        <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Sort Items" name="orderby" id="orderby">
                            <option value="-1" {{$order == -1 ? 'selected' : ''}}>Podrazumijevano</option>
                            <option value="1" {{$order == 1 ? 'selected' : ''}}>Najnovije</option>
                            <option value="2" {{$order == 2 ? 'selected' : ''}}>Najstarije</option>
                            <option value="3" {{$order == 3 ? 'selected' : ''}}>Najjeftinije</option>
                            <option value="4" {{$order == 4 ? 'selected' : ''}}>Najskuplje</option>
                        </select>

                        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

                        <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2" style="color: darkblue;">Prikaz: </span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid" data-cols="4">4</button>
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside" data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @foreach($products as $product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{route('shop.product.details', ['product_slug'=>$product->slug])}}"><img loading="lazy" src={{asset('uploads/products')}}/{{$product->image}} width="330" height="400" alt="{{$product->name}}" class="pc__img"></a>
                                            </div>
                                            <div class="swiper-slide">
                                                @foreach(explode(',', $product->images) as $gImage)
                                                <a href="{{route('shop.product.details', ['product_slug'=>$product->slug])}}"><img loading="lazy" src="{{asset('uploads/products')}}/{{$gImage}}" width="330" height="400" alt="{{$product->name}}" class="pc__img"></a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_prev_sm" />
                                            </svg>
                                        </span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_next_sm" />
                                            </svg>
                                        </span>
                                    </div>
                                    @if(Cart::instance('cart')->content()->where('id', $product->id)->count()>0)
                                        <a href="{{route('cart.index')}}" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning mb-3">U korpi</a>
                                    @else
                                        <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="name" value="{{$product->name}}">
                                            <input type="hidden" name="price" value="{{$product->sale_price == ''? $product->regular_price : $product->sale_price}}">
                                            @if($product->quantity == 0)
                                                <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" disabled data-aside="cartDrawer" title="Add To Cart">Rasprodato</button>
                                            @else
                                                <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" data-aside="cartDrawer" title="Add To Cart">Dodaj u korpu</button>
                                            @endif
                                        </form>
                                    @endif
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{$product->category->name}}</p>
                                    <h6 class="pc__title"><a href="{{route('shop.product.details', ['product_slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if($product->sale_price != $product->regular_price)
                                                <s> {{$product->regular_price}} KM </s> {{$product->sale_price}} KM
                                            @else
                                            {{$product->regular_price}} KM
                                            @endif
                                        </span>
                                    </div>
                                    @if(Auth::user())
                                        @if(Auth::user() && Auth::user()->favoriteProducts->contains($product->id))
                                            <form method="POST" action="{{ route('wishlist.item.remove', ['rowId' => $product->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist filled-heart" title="Omiljeni artikal">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{route('wishlist.add')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$product->id}}" />
                                                <input type="hidden" name="name" value="{{$product->name}}" />
                                                <input type="hidden" name="price" value="{{$product->sale_price != $product -> regular_price ? $product->sale_price : $product -> regular_price}}" />
                                                <input type="hidden" name="quantity" value="1" />
                                                <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Dodaj u omiljene artikle">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$products ->withQueryString()->links('pagination::bootstrap-5')}}
                </div>
                </div>
        </section>
    </main>

    <form id="frmfilter" method="GET" action="{{route('shop.index')}}">
        <input type="hidden" name="page" value="{{$products->currentPage()}}">
        <input type="hidden" name="size" id="size" value="{{$size}}">
        <input type="hidden" name="order" id="order" value="{{$order}}">
        <input type="hidden" name="brands" id="hdnBrands" >
        <input type="hidden" name="categories" id="hdnCategories">
        <input type="hidden" id="hdnGenders" name="genders" value="{{ implode(',', $f_genders) }}">
        <input type="hidden" name="min" id="hdnMinPrice" value="{{$minPrice}}">
        <input type="hidden" name="max" id="hdnMaxPrice" value="{{$maxPrice}}">
    </form>

@endsection

@push('scripts')
    <script>
        $(function(){
            $("#pagesize").on("change", function(){
                $("#size").val($("#pagesize option:selected").val());
                $("#frmfilter").submit();
            })

            $("#orderby").on("change", function(){
                $("#order").val($("#orderby option:selected").val());
                $("#frmfilter").submit();
            })

            $("input[name='brands']").on("change", function (){
                var brands = "";
                $("input[name='brands']:checked").each(function (){
                    if(brands == ""){
                        brands += $(this).val();
                    }
                    else{
                        brands += ',' + $(this).val();
                    }
                });
                $("#hdnBrands").val(brands);
                $("#frmfilter").submit();
            });

            $("input[name='categories']").on("change", function (){
                var categories = "";
                $("input[name='categories']:checked").each(function (){
                    if(categories == ""){
                        categories += $(this).val();
                    }
                    else{
                        categories += ',' + $(this).val();
                    }
                });
                $("#hdnCategories").val(categories);
                $("#frmfilter").submit();
            });

            $("input[name='genders']").on("change", function () {
                var genders = "";
                $("input[name='genders']:checked").each(function () {
                    if (genders == "") {
                        genders += $(this).val();
                    } else {
                        genders += ',' + $(this).val();
                    }
                });
                $("#hdnGenders").val(genders);
                $("#frmfilter").submit();
            });


            $("[name='price_range']").on("change", function(){
                var min = $(this).val().split(',')[0];
                var max = $(this).val().split(',')[1];
                $("#hdnMinPrice").val(min);
                $("#hdnMaxPrice").val(max);

                setTimeout(()=>{
                    $("#frmfilter").submit();
                }, 2000);
            });
        });
    </script>
@endpush

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'skiXperience') }}</title>

    <!-- Fonts
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('font/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('font/fonts.css')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('icon/style.css')}} ">
    @stack("styles")
</head>
<style>
    .product-item {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 15px;
        transition: all 0.3s ease;
        padding-right: 5px;
    }

    .product-item .image {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        gap: 10px;
        flex-shrink: 0;
        padding: 5px;
        border-radius: 10px;
        background: #EFF4F8;
    }

    #box-content-search{
        list-style: none;
    }

    #box-content-search .product-item{
        margin-bottom: 10px;
    }
</style>
<body class="body">
<div id="wrapper">
    <div id="page" class="">
        <div class="layout-wrap">
            <div class="section-menu-left full-width">
                <div class="box-logo">
                    <a href="{{route('home.index')}}" id="site-logo-inner">
                        <img class="" id="logo_header_1" alt="" src="{{asset('images/logo/logo.png')}}" data-light="{{asset('images/logo/logo.png')}}" data-dark="{{asset('images/logo/logo.png')}}">
                    </a>
                    <div class="button-show-hide">
                        <i class="icon-menu-left"></i>
                    </div>
                </div>
                <div class="center">
                    <div class="center-item">
                        <br><br>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="{{route('admin.index')}}" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Statistika</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="center-item">
                        <ul class="menu-list">
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-shopping-cart"></i></div>
                                    <div class="text">Artikli</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.product.add')}}" class="">
                                            <div class="text">Dodaj artikal</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.products')}}" class="">
                                            <div class="text">Svi artikli</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Brendovi</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.brand.add')}}" class="">
                                            <div class="text">Dodaj brend</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.brands')}}" class="">
                                            <div class="text">svi brendovi</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Kategorije</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.category.add')}}" class="">
                                            <div class="text">Dodaj kategoriju</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{route('admin.categories')}}" class="">
                                            <div class="text">Sve kategorije</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('admin.orders')}}" class="menu-item-button">
                                    <div class="icon"><i class="icon-file-plus"></i></div>
                                    <div class="text">Narudžbe</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('admin.slides')}}" class="">
                                    <div class="icon"><i class="icon-image"></i></div>
                                    <div class="text">Promocije</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('admin.coupons')}}" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Kuponi</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('admin.contacts')}}" class="">
                                    <div class="icon"><i class="icon-mail"></i></div>
                                    <div class="text">Poruke</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <form method="POST" action="{{route('logout')}}" id="logout-form">
                                    @csrf
                               <a href="{{route('logout')}}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <div class="icon"><i class="icon-settings"></i></div>
                                    <div class="text">Odjava</div>
                                </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="section-content-right">
                <div class="header-dashboard">
                    <div class="wrap">
                        <div class="header-left">
                            <a href="{{route('home.index')}}">
                                <img class="" id="logo_header_mobile" alt="" src="{{asset('images/logo/logo.png')}}" data-light="images/logo/logo.png" data-dark="images/logo/logo.png" data-width="154px" data-height="52px" data-retina="images/logo/logo.png">
                            </a>
                            <div class="button-show-hide">
                                <i class="icon-menu-left"></i>
                            </div>
                            <form class="form-search flex-grow">
                                <fieldset class="name">
                                    <input type="text" placeholder="Pretraži..." id="search-input" class="show-search" name="name" autocomplete="off" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" disabled type="submit"><i class="icon-search"></i></button>
                                </div>
                                <div class="box-content-search" >
                                    <ul id="box-content-search">
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="header-grid" style="padding-right: 30px">
                            <div class="popup-wrap user type-header">
                                <div class="dropdown">
                                    <span class="header-user wg-user">
                                        <span class="image">
                                            <img src="{{asset('images/avatar/admin.jpg')}}" alt="">
                                        </span>
                                        <span class="flex flex-column">
                                            <span class="body-title mb-2">{{Auth::user()->name}}</span>
                                            <span class="text-tiny">Administrator</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content">
                    @yield('content');
                    <div class="bottom-page">
                        <div class="body-text">Copyright © 2025 skiXperience</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/apexcharts/apexcharts.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    $(function(){
        $("#search-input").on("keyup", function (){
            var searchQuery = $(this).val();
            if(searchQuery.length>2)
            {
                $.ajax({
                    type:"GET",
                    url: "{{route('admin.search')}}",
                    data: {query: searchQuery},
                    dataType: 'json',
                    success: function(data){
                        $("#box-content-search").html('');
                        $.each(data, function (index, item){
                            var url = "{{route('admin.product.edit', ['id'=>'product_id'])}}";
                            var link = url.replace('product_id', item.id);

                            $("#box-content-search").append(`
                               <li>
                                    <ul>
                                        <li class="product-item gap14 mb-10">
                                            <div class="image no-bg">
                                                <img src="{{asset('uploads/products/thumbnails')}}/${item.image}" alt="${item.name}">
                                            </div>
                                            <div class="flex items-center justify-between gap20 flex-grow>
                                                <div class="name">
                                                    <a href="${link}" class="body-text">${item.name}</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-10">
                                            <div class="divider"></div>
                                        </li>
                                    </ul>
                               </li>
                               `);
                        });
                    }
                });
            }
        });
    });
</script>
@stack("scripts")
</body>
</html>

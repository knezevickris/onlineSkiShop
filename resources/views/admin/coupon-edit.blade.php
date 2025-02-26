@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Detalji kupona</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('admin.index')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{route('admin.coupons')}}">
                            <div class="text-tiny">Kuponi</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Izmjeni kupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{route('admin.coupon.update')}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$coupon->id}}"/>
                    <fieldset class="name">
                        <div class="body-title">Kod <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Kod kupona" name="code" tabindex="0" value="{{$coupon->code}}" aria-required="true" required="">
                    </fieldset>
                    @error('code') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="category">
                        <div class="body-title">Tip popusta <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select class="" name="type">
                                <option value="">Izaberi...</option>
                                <option value="fixed" {{$coupon->type=='fixed' ? 'selected' : ''}}>Fiksni</option>
                                <option value="percent" {{$coupon->type=='percent' ? 'selected' : ''}}>Procentualni</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('type') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Vrijednost kupona" name="value" tabindex="0" value="{{$coupon->value}}" aria-required="true" required="">
                    </fieldset>
                    @error('value') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="name">
                        <div class="body-title">Vrijednost u korpi <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Minimalni iznos korpe za ostvarivanje popusta" name="cart_value" tabindex="0" value="{{$coupon->cart_value}}" aria-required="true" required="">
                    </fieldset>
                    @error('cart_value') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="name">
                        <div class="body-title">Datum važenja <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="date" placeholder="Kupon je moguće iskoristiti do datuma" name="expiry_date" tabindex="0" value="{{old($coupon->expiry_date)}}" aria-required="true" required="">
                    </fieldset>
                    @error('expiry_date') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Sačuvaj izmjene</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

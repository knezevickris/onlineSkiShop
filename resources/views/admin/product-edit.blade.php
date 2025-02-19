@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Izmjena podataka o artiklu</h3>
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
                        <a href="{{route('admin.products')}}">
                            <div class="text-tiny">Artikli</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Izmjena podataka o artiklu</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"  action="#">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Naziv artikla <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Unesite naziv artikla"
                               name="name" tabindex="0" value="{{$product->name}}" aria-required="true" required="">
                        <div class="text-tiny">Dužina naziva artikla je ograničena na 250 karaktera.</div>
                    </fieldset>
                    @error('name') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Simboličko ime proizvoda"
                               name="slug" tabindex="0" value="{{$product->slug}}" aria-required="true" required="">
                        <div class="text-tiny">Sva polja označena sa * je obavezno popuniti. </div>
                    </fieldset>
                    @error('slug') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Kategorija <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Izaberite kategoriju...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('category_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brend <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Izaberite brend...</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}"  {{$product->brand_id == $brand->id ? "selected" : ""}}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    </div>
                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Kratak opis <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Kratak opis artikla" tabindex="0" aria-required="true" required="">{{$product->short_description}}</textarea>
                        <div class="text-tiny">Dužina opisa je ograničena na 250 karaktera.</div>
                    </fieldset>
                    @error('short_description') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset class="description">
                        <div class="body-title mb-10">Detalji <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Detalji o artiklu" tabindex="0" aria-required="true" required="">{{$product->description}}</textarea>
                        <div class="text-tiny">Dužina detaljnog opisa artikla je ograničena na 1000 karaktera.</div>
                    </fieldset>
                    @error('description') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Unos slike <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if($product->image)
                                <div class="item" id="imgpreview" >
                                    <img src="{{asset('uploads/products')}}/{{$product->image}}" class="effect8" alt="{{$product->name}}">
                                </div>
                            @endif
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="body-text">Prevuci sliku ovde ili <span class="tf-color">klikni da pretražiš</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <fieldset>
                        <div class="body-title mb-10">Unos više slika</div>
                        <div class="upload-image mb-16">
                            @if($product->images)
                                @foreach(explode(',', $product->images) as $img)
                                <div class="item gitems">
                                    <img src="{{asset('uploads/products')}}/{{trim($img)}}"  alt="">
                                </div>
                                @endforeach
                            @endif
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="text-tiny">Prevuci slike ovde ili <span class="tf-color">klikni da pretražiš</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('images') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Vrijednost <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Unesite novčanu vrijednost artikla" name="regular_price" tabindex="0" value="{{$product->regular_price}}" aria-required="true"  required="">
                        </fieldset>
                        @error('regular_price') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Prodajna cijena <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Unesite prodajnu cijenu" name="sale_price" tabindex="0" value="{{$product->sale_price}}" aria-required="true" required="">
                        </fieldset>
                        @error('sale_price') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    </div>
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Bar-kod <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Unesite bar-kod artikla" name="SKU" tabindex="0" value="{{$product->SKU}}" aria-required="true" required="">
                        </fieldset>
                        @error('SKU') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Količina <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Unesite količinu" name="quantity" tabindex="0" value="{{$product->quantity}}" aria-required="true" required="">
                        </fieldset>
                        @error('quantity') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    </div>
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Dostupnost</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock"   {{$product->stock_status == "instock" ? "selected" : ""}}>Da</option>
                                    <option value="outofstock" {{$product->stock_status == "outstock" ? "selected" : ""}}>Ne</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('stock_status') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Istaknutno</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0"  {{$product->featured == "0" ? "selected" : ""}}>Ne</option>
                                    <option value="1"  {{$product->featured == "1" ? "selected" : ""}}>Da</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Sačuvaj artikal</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change", function (e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file){
                    $("#imgpreview img").attr('src',URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("#gFile").on("change", function (e){
                const photoInp = $("#gFile");
                const gPhotos = this.files;
                $.each(gPhotos, function(key, val){
                    $("#galUpload").prepend(`<div class="item gitems"><img src="${URL.createObjectURL(val)}"></div>`);
                });
            });

            $("input[name='name']").on("change", function (){
                $("input[name='slug']").val(stringToSlug($(this).val()));
            });
        });

        function stringToSlug(text){
            return text.toLowerCase()
                .replace(/[^\w ]+/g,"")
                .replace(/ +/g,"-");
        }

    </script>
@endpush

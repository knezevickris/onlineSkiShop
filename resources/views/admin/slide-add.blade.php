@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Nova promocija</h3>
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
                        <a href="{{route('admin.slides')}}">
                            <div class="text-tiny">Promocije</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Nova promocija</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{route('admin.slide.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <fieldset class="name">
                        <div class="body-title">Tagline <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Unesite tagline" name="tagline" tabindex="0" value="{{old('tagline')}}" aria-required="true" required="">
                    </fieldset>
                    @error('tagline')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <fieldset class="name">
                        <div class="body-title">Naslov <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Unesite naslov" name="title" tabindex="0" value="{{old('title')}}" aria-required="true" required="">
                    </fieldset>
                    @error('title')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <fieldset class="name">
                        <div class="body-title">Podnaslov <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Unesite podnaslov" name="subtitle" tabindex="0" value="{{old('subtitle')}}" aria-required="true" required="">
                    </fieldset>
                    @error('subtitle')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <fieldset class="name">
                        <div class="body-title">Link <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Unesite link" name="link" tabindex="0" value="{{old('link')}}" aria-required="true" required="">
                    </fieldset>
                    @error('link')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <fieldset>
                        <div class="body-title">Dodaj slike <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none;">
                                <img src="sample.jpg" class="effect-8" alt="" />
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="body-text">Prevuci slike ovde ili <span class="tf-color">klikni da pretražiš</span></span>
                                    <input type="file" id="myFile" name="image">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <fieldset class="category">
                        <div class="body-title">Izaberi status</div>
                        <div class="select flex-grow">
                            <select class="" name="status">
                                <option>Izaberi...</option>
                                <option value="1" @if(old('status')=="1") selected @endif>Aktivna</option>
                                <option value="0" @if(old('status')=="0") selected @endif>Neaktivna</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('status')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
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

            $("input[name='name']").on("change", function (){
                $("input[name='slug']").val(stringToSlug($(this).val()));
            });
        });
    </script>
@endpush

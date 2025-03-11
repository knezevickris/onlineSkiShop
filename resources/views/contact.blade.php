@extends('layouts.app')
@section('content')
    <style>
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
        }

        label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            padding: 0 5px;
            transition: all 0.3s ease;
            color: gray;
            font-size: 16px;
            pointer-events: none;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label{
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
            padding: 0 5px;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">Kontaktirajte nas</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary " />
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <div class="contact-us__form">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <form name="contact-us-form" class="needs-validation form-group" novalidate="" method="POST" action="{{route('home.contact.store')}}">
                        @csrf
                        @method('POST')
                        <h3 class="mb-5">Obratite nam se Vašom pohvalom ili žalbom i naša služba će Vam odgovoriti u najkraćem roku.</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder=" " value="{{old('name')}}" required="">
                            <label for="contact_us_name">Ime i prezime *</label>
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder=" " value="{{old('phone')}}" required="">
                            <label for="contact_us_name">Broj telefona *</label>
                            @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder=" " value="{{old('email')}}" required="">
                            <label for="contact_us_name">Email adresa *</label>
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control_gray" name="comment" placeholder="Unesite komentar"  cols="30" rows="8" required="">{{old('name')}}</textarea>
                            @error('comment')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Pošalji</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

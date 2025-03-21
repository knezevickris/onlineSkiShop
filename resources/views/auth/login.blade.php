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
        input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
            padding: 0 5px;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login"
                       role="tab" aria-controls="tab-item-login" aria-selected="true">Prijava</a>
                </li>
            </ul>
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
                    <div class="login-form">
                        <form method="POST" action="{{route('login')}}" name="login-form" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <input class="form-control form-control_gray @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" autocomplete="email" autofocus="" placeholder=" ">
                                <label for="email">Email adresa *</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" >
                                <input id="password" style="letter-spacing: 0; font-family: inherit" type="password" class="form-control form-control_gray @error('password') is-invalid @enderror " name="password" required="" autocomplete="current-password" placeholder=" ">
                                <label for="customerPasswodInput">Lozinka *</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">Prijavi se</button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">Još uvijek niste registrovani? </span>
                                <a href="{{route('register')}}" class="btn-text js-show-register">Kreiraj nalog</a>
                            </div>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">Zaboravili ste lozinku?</span>
                                <a href="{{route('password.request')}}" class="btn-text">Resetuj lozinku</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@extends('layouts.app')

@section('content')
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
                            <div class="form-floating mb-3">
                                <input class="form-control form-control_gray @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" autocomplete="email"
                                       autofocus="" placeholder="Email adresa">
                               <!-- <label for="email">Email adresa *</label> -->
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3" >
                                <input id="password" type="password" class="form-control form-control_gray @error('password') is-invalid @enderror" name="password" required=""
                                       autocomplete="current-password" placeholder="Lozinka">
                               <!-- <label for="customerPasswodInput"">Lozinka *</label> -->
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
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                       href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="true">Registracija</a>
                </li>
            </ul>
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="{{route('register')}}" name="register-form" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control form-control_gray @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required="" autocomplete="name"
                                       autofocus="">
                                <label for="name">Ime</label>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="pb-3"></div>
                            <div class="form-floating mb-3">
                                <input id="email" type="email" class="form-control form-control_gray @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required=""
                                       autocomplete="email">
                                <label for="email">Email adresa *</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input id="mobile" type="text" class="form-control form-control_gray @error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}"
                                       required="" autocomplete="mobile">
                                <label for="mobile">Broj telefona *</label>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password" class="form-control form-control_gray @error('password') is-invalid @enderror" name="password" required=""
                                       autocomplete="new-password">
                                <label for="password">Lozinka *</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control form-control_gray"
                                       name="password_confirmation" required="" autocomplete="new-password">
                                <label for="password">Potvrda lozinke *</label>
                            </div>

                            <div class="d-flex align-items-center mb-3 pb-2">
                                <p class="m-0">Lični podaci će se koristiti za podršku vašem iskustvu na ovoj veb stranici, za
                                    upravljanje pristupom nalogu i za druge svrhe opisane u našoj politici privatnosti.</p>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">Registruj se</button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">Već posjeduješ nalog?</span>
                                <a href="{{route('login')}}" class="btn-text js-show-register">Prijavi se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

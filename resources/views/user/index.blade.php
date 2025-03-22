@extends('layouts.app')
@section('content')
    <style>
        .user-info {
            margin-bottom: 15px;
        }

        .user-info label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .user-field {
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #555;
            width: 100%;
            max-width: 400px;
        }

        .user-greeting p {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
            padding: 10px 15px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Moj nalog</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        <div class="user-greeting">
                            <p>Zdravo <strong>{{Auth::user()->name}}</strong></p>
                        </div><br><br>
                        <div class="user-info">
                            <label>Email adresa:</label>
                            <div class="user-field">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="user-info">
                            <label>Datum registracije:</label>
                            <div class="user-field">{{ Auth::user()->created_at->format('d.m.Y') }}</div>
                        </div>
                    </div><br><br>
                    @if(session('success'))
                        <div class="alert alert-success" role="alert" style="background-color: #d4edda; color: #155724; padding: 10px; border-left: 5px solid #28a745; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('password.change') }}" class="btn btn-secondary mt-3">Promijeni lozinku</a>
                </div>
            </div>
        </section>
    </main>
@endsection

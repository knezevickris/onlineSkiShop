@extends('layouts.app')
@section('content')
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
                        <p>Zdravo <strong>{{Auth::user()->name}}</strong></p>
                        <p>Ovdje možete vidjeti Vaše <a class="unerline-link" href="account_orders.html">nedavne narudžbe</a>, upravljati <a class="unerline-link" href="account_edit_address.html">adresama za isporuku</a>, i <a class="unerline-link" href="account_edit.html">izmjeniti lozinku i detalje naloga.</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

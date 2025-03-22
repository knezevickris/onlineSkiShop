@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
            <section class="my-account container">
                <h2 class="page-title">Istorija adresa</h2>
                <div class="row">
                    <div class="col-lg-2">
                        @include('user.account-nav')
                    </div>
                    <div class="col-lg-10">
                        <br>
                        @if($addresses->isEmpty())
                            <div class="text-center my-5">
                                <h4 class="text-muted">Istorija adresi je prazna.</h4>
                                <p class="text-secondary">Napravite vašu prvu narudžbu i istražite našu ponudu!</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">Idi u prodavnicu</a>
                            </div>
                        @else
                            <div class="wg-table table-all-user">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="border: 0.5px solid gray; border-radius: 0.5px;"">
                                        <thead style="background-color: #6a6e51; font-weight: 500; ">
                                            <tr>
                                                <td class="text-center">Ulica i broj</td>
                                                <td class="text-center">Grad</td>
                                                <td class="text-center">Država</td>
                                                <td class="text-center">Poštanski broj</td>
                                                <td class="text-center">Datum kreiranja</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($addresses as $address)
                                            <tr style="border-bottom: 0.5px solid gray;">
                                                <td class="text-center">{{$address->address}}</td>
                                                <td class="text-center">{{$address->city}}</td>
                                                <td class="text-center">{{$address->country}}</td>
                                                <td class="text-center">{{$address->zip}}</td>
                                                <td class="text-center">{{$address->created_at->format('d.m.Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
    </main>
@endsection

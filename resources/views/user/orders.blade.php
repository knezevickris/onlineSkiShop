@extends('layouts.app')
@section('content')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
        }
        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }
        .text-dark-red {
            color: #b30000;
        }

        .text-dark-green {
            color: #006400;
        }
    </style>
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Istorija narudžbi</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-10">
                    <br>
                    @if($orders->isEmpty())
                        <div class="text-center my-5">
                            <h4 class="text-muted">Istorija narudžbi je prazna.</h4>
                            <p class="text-secondary">Napravite vašu prvu narudžbu i istražite našu ponudu!</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary">Idi u prodavnicu</a>
                        </div>
                    @else
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Id narudžbe</th>
                                    <th class="text-center">Ime i prezime</th>
                                    <th class="text-center">Broj telefona</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">PDV</th>
                                    <th class="text-center">Ukupna cijena</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Datum kreiranja</th>
                                    <th class="text-center">Broj artikala</th>
                                    <th class="text-center">Datum isporuke</th>
                                    <th class="text-center">Detalji</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center">{{$order->id}}</td>
                                        <td class="text-center">{{$order->name}}</td>
                                        <td class="text-center">{{$order->phone}}</td>
                                        <td class="text-center">{{$order->subtotal}} KM</td>
                                        <td class="text-center">{{$order->tax}} KM</td>
                                        <td class="text-center">{{$order->total}} KM</td>
                                        <td class="text-center">
                                            @if($order->status == 'delivered')
                                                <span class="badge bg-success">Isporučena</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="badge bg-danger">Otkazana</span>
                                            @else
                                                <span class="badge bg-warning">Kreirana</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{$order->created_at}}</td>
                                        <td class="text-center">{{$order->orderItems->count()}}</td>
                                        <td class="text-center">
                                            @if(empty($order->delivered_date) && $order->status=='canceled')
                                                <span class="text-dark-red">Isporuka otkazana.</span>
                                            @elseif(empty($order->delivered_date))
                                                <span class="text-dark-green">Isporuka u toku.</span>
                                            @else
                                                {{$order->delivered_date}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('user.order.details', ['order_id'=>$order->id])}}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="fa fa-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{$orders->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

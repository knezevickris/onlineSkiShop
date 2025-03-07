@extends('layouts.app')
@section('content')
    <style>
        .pt-90 {
            padding-top: 90px !important;
        }

        .pr-6px {
            padding-right: 6px;
            text-transform: uppercase;
        }

        .my-account .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 40px;
            border-bottom: 1px solid;
            padding-bottom: 13px;
        }

        .my-account .wg-box {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            padding: 24px;
            flex-direction: column;
            gap: 24px;
            border-radius: 12px;
            background: var(--White);
            box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
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

        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;

        }

        .table-transaction th,
        .table-transaction td {
            padding: 0.625rem 1.5rem .25rem !important;
            color: #000 !important;
        }

        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .25rem !important;
            background-color: #6a6e51 !important;
        }

        .table-bordered>:not(caption)>*>* {
            border-width: inherit;
            line-height: 32px;
            font-size: 14px;
            border: 1px solid #e1e1e1;
            vertical-align: middle;
        }

        .table-striped .image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-striped td:nth-child(1) {
            min-width: 250px;
            padding-bottom: 7px;
        }

        .pname {
            display: flex;
            gap: 13px;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }
    </style>
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Detalji narudžbe</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-10">
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Osnovne informacije o narudžbi</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="btn btn-sm btn-danger" href="{{route('user.orders')}}">Nazad</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(Session::has('status'))
                                <p class="alert alert-success">{{Session::get('status')}}</p>
                            @endif
                            <table class="table table-bordered table-striped table-transaction">
                                <tr>
                                    <th>Id narudžbe</th>
                                    <td>{{$order->id}}</td>
                                    <th>Broj telefona</th>
                                    <td>{{$order->phone}}</td>
                                    <th>Poštanski broj</th>
                                    <td>{{$order->zip}}</td>
                                </tr>
                                <tr>
                                    <th>Datum kreiranja</th>
                                    <td>{{$order->created_at}}</td>
                                    <th>Datum isporuke</th>
                                    <td>
                                        @if(empty($order->delivered_date) && $order->status=='canceled')
                                            <span class="text-dark-red">Isporuka otkazana.</span>
                                        @elseif(empty($order->delivered_date))
                                            <span class="text-dark-green">Isporuka u toku.</span>
                                        @else
                                            {{$order->delivered_date}}
                                        @endif
                                    </td>
                                    <th>Napomena</th>
                                    <td>{{empty($order->customer_note)? 'Nema dodatne napomene.' : $order->customer_note}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td colspan="5">
                                        @if($order->status == 'delivered')
                                            <span class="badge bg-success">Isporučena</span>
                                        @elseif($order->status == 'canceled')
                                            <span class="badge bg-danger">Otkazana</span>
                                        @else
                                            <span class="badge bg-warning">Kreirana</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <h5>Artikli u narudžbi</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Naziv artikla</th>
                                    <th class="text-center">Cijena</th>
                                    <th class="text-center">Količina</th>
                                    <th class="text-center">Bar kod</th>
                                    <th class="text-center">Kategorija</th>
                                    <th class="text-center">Brend</th>
                                    <th class="text-center">Opcije</th>
                                    <th class="text-center">Povrat</th>
                                    {{--                            <th class="text-center">Akcije</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderItems as $orderItem)
                                    <tr>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{asset('uploads/products/thumbnails')}}/{{$orderItem->product->image}}" alt="{{$orderItem -> product-> name}}" class="image">
                                            </div>
                                            <div class="name">
                                                <a href="{{route('shop.product.details', ['product_slug' => $orderItem->product->slug])}}" target="_blank"
                                                   class="body-title-2">{{$orderItem -> product-> name}}</a>
                                            </div>
                                        </td>
                                        <td class="text-center">{{$orderItem -> price}}</td>
                                        <td class="text-center">{{$orderItem -> quantity}}</td>
                                        <td class="text-center">{{$orderItem -> product -> SKU}}</td>
                                        <td class="text-center">{{$orderItem -> product -> category -> name}}</td>
                                        <td class="text-center">{{$orderItem -> product -> brand -> name}}</td>
                                        <td class="text-center">{{$orderItem -> options}}</td>
                                        <td class="text-center">{{$orderItem -> rstatus == 0 ? 'Ne' : 'Da'}}</td>
                                        {{--                                    <td class="text-center">--}}
                                        {{--                                        <div class="list-icon-function view-icon">--}}
                                        {{--                                            <div class="item eye">--}}
                                        {{--                                                <i class="icon-eye"></i>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                            {{$orderItems -> links('pagination::bootstrap-5')}}
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Adresa isporuke</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__detail">
                                <p>{{$order->name}}</p>
                                <p>{{$order -> adress}}</p>
                                <p>{{$order -> city}} </p>
                                <p>{{$order -> country}}</p>
                                <p>{{$order -> zip}}</p>
                                <br>
                                <p>Broj telefona: {{$order -> phone}}</p>
                                <p>Email adresa: {{$order -> email}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Transakcije</h5>
                        <table class="table table-striped table-bordered table-transaction">
                            <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>{{$order -> subtotal}} KM</td>
                                <th>PDV</th>
                                <td>{{$order -> tax}} KM</td>
                                <th>Popust</th>
                                <td>{{$order->discount}} KM</td>
                            </tr>
                            <tr>
                                <th>Ukupno</th>
                                <td>{{$order->total}} KM</td>
                                <th>Način plaćanja</th>
                                {{--                            <td>{{$transaction->mode}}</td>--}}
                                <td>Gotovina</td>
                                <th>Status</th>
                                <td>
                                    @if($transaction->status == 'approved')
                                        <span class="badge bg-success">Privaćena</span>
                                    @elseif($transaction->status == 'declined')
                                        <span class="badge bg-danger">Odbijena</span>
                                    @elseif($transaction->status == 'refunded')
                                        <span class="badge bg-secondary">Refundirana</span>
                                    @else
                                        <span class="badge bg-warning">Na čekanju</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($order->status == 'ordered')
                        <div class="wg-box mt-5 text-right">
                            <form action="{{route('user.order.cancel')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <button type="button" class="btn btn-danger cancel-order">Otkaži narudžbu</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.cancel-order').on('click', function(e){
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Potvrda",
                    text: "Da li ste sigurni da želite otkazati izabranu narudžbu?",
                    type: "warning",
                    buttons:["Ne", "Da"],
                    confirmButtonColor: '#dc3545'
                }).then(function(result){
                    if(result)
                        form.submit();
                });
            });
        });
    </script>
@endpush


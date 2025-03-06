@extends('layouts.admin')
@section('content')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Svi detalji narudžbe</h3>
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
                        <div class="text-tiny">Detalji narudžbe</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Detalji narudžbe</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Nazad</a>
                </div>
                <div class="table-responsive">
                    @if(Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Redni br.</th>
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
                            <td>{{$order->delivered_at}}</td>
                            <th>Napomena</th>
                            <td>{{empty($order->customer_note) ? 'Nema dodatne napomene' : $order->customer_note}}</td>
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

            <div class="wg-box mt-5">
                <h5>Ažuriraj status naredbe</h5>
                <form action="{{route('admin.order.status.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select">
                                <select id="order_status" name="order_status">
                                    <option value="ordered" {{$order->status == 'ordered' ? "selected" : ""}}>Kreirana</option>
                                    <option value="delivered" {{$order->status == 'delivered' ? "selected" : ""}}>Isporučena</option>
                                    <option value="canceled" {{$order->status == 'canceled' ? "selected" : ""}}>Otkazana</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary tf-button w208">Sačuvaj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('content')
    <style>
        .text-dark-red {
            color: #b30000;
        }

        .text-dark-green {
            color: #006400;
        }
    </style>

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Sve narudžbe</h3>
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
                        <div class="text-tiny">Narudžbe</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Id narudžbe</th>
                                <th class="text-center">Ime naručioca</th>
                                <th class="text-center">Broj telefona</th>
                                <th class="text-center">Iznos bez PDV-a [KM]</th>
                                <th class="text-center">PDV [KM]</th>
                                <th class="text-center">Ukupna cijena [KM]</th>
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
                                    <td class="text-center">{{$order->subtotal}}</td>
                                    <td class="text-center">{{$order->tax}}</td>
                                    <td class="text-center">{{$order->total}}</td>
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
                                        <a href="{{route('admin.order.details', ['order_id'=>$order->id])}}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
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
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$orders->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection

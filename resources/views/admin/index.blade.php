@extends('layouts.admin')
@section('content')
     <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Ukupno narudžbi</div>
                                        <h4>{{$dashboardDatas[0]->Total}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Ukupan iznos</div>
                                        <h4>{{$dashboardDatas[0]->TotalAmount}} KM</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Narudžbe na čekanju</div>
                                        <h4>{{$dashboardDatas[0]->TotalOrdered}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Iznos narudžbi na čekanju</div>
                                        <h4>{{$dashboardDatas[0]->TotalOrderedAmount}} KM</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Isporučene narudžbe</div>
                                        <h4>{{$dashboardDatas[0]->TotalDelivered}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Iznos isporučenih narudžbi</div>
                                        <h4>{{$dashboardDatas[0]->TotalDeliveredAmount}} KM</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Otkazane narudžbe</div>
                                        <h4>{{$dashboardDatas[0]->TotalCanceled}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Iznos otkazanih narudžbi</div>
                                        <h4>{{$dashboardDatas[0]->TotalCanceledAmount}} KM</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Mjesečna zarada</h5>
                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t1"></div>
                                    <div class="text-tiny">Ukupan prihod</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{$totalAmount}} KM</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">Narudžbe na cekanju</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{$totalOrderedAmount}} KM</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">Isporucene narudzbe</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{$totalDeliveredAmount}} KM</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">Otkazane narudzbe</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{$totalCanceledAmount}} KM</h4>
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-8"></div>
                </div>

            </div>
            <div class="tf-section mb-30">

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Nedavne narudžbe</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="{{route('admin.orders')}}">
                                <span class="view-all">Prikaži sve</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Id narudžbe</th>
                                    <th class="text-center">Ime naručioca</th>
                                    <th class="text-center">Broj telefona</th>
                                    <th class="text-center">Subtotal [KM]</th>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function ($) {

            var tfLineChart = (function () {

                var chartBar = function () {

                    var options = {
                        series: [{
                            name: 'Total',
                            data: [{{$amountM}}]
                        }, {
                            name: 'Pending',
                            data: [{{$orderedAmountM}}]
                        },
                            {
                                name: 'Delivered',
                                data: [{{$deliveredAmountM}}]
                            }, {
                                name: 'Canceled',
                                data: [{{$canceledAmountM}}]
                            }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + val + ""
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function () { },

                    load: function () {
                        chartBar();
                    },
                    resize: function () { },
                };
            })();

            jQuery(document).ready(function () { });

            jQuery(window).on("load", function () {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function () { });
        })(jQuery);
    </script>
@endpush

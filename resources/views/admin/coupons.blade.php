@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Kuponi za popuste</h3>
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
                        <div class="text-tiny">Kuponi</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <a class="tf-button style-1 w208" href="{{route('admin.coupon.add')}}"><i class="icon-plus"></i>Dodaj novi</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        @if(Session::has('status'))
                            <p class="alert alert-success">{{Session::get('status')}}</p>
                        @endif
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <!--<th>#</th>-->
                                <th>Kod</th>
                                <th>Tip</th>
                                <th>Vrijednost</th>
                                <th>Minimalna vrijedost korpe</th>
                                <th>Važi do</th>
                                <th>Akcije</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                  <!--  <td>{{$coupon->id}}</td> -->
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->type}}</td>
                                    <td>{{$coupon->value}}</td>
                                    <td>{{$coupon->cart_value}} KM</td>
                                    <td>{{$coupon->expiry_date}}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{route('admin.coupon.edit', ['id'=>$coupon->id])}}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{route('admin.coupon.delete', ['id'=>$coupon->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$coupons->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.delete').on('click', function(e){
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Potvrda brisanja",
                    text: "Da li ste sigurni da želite obrisati izabrani kupon?",
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

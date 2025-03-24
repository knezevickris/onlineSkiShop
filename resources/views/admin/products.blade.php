@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Svi artikli</h3>
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
                        <div class="text-tiny">Svi artikli</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <a class="tf-button style-1 w208" href="{{route('admin.product.add')}}"><i class="icon-plus"></i>Dodaj novi</a>
                </div>
                <div class="table-responsive">
                    @if(Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">Naziv</th>
                            <th class="text-center">Cijena</th>
                            <th class="text-center">Prodajna cijena</th>
                            <th class="text-center">Kategorija</th>
                            <th class="text-center">Brend</th>
                            <th class="text-center">Više veličina</th>
                            <th class="text-center">Pol</th>
                            <th class="text-center">Dostupno</th>
                            <th class="text-center">Količina</th>
                            <th class="text-center">Akcije</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" alt="{{$product->name}}" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" class="body-title-2">{{$product->name}}</a>
                                    <div class="text-tiny mt-3">{{$product->slug}}</div>
                                </div>
                            </td>
                            <td class="text-center">{{$product->regular_price}} KM</td>
                            <td class="text-center">{{$product->sale_price}} KM</td>
                            <td class="text-center">{{$product->category->name}}</td>
                            <td class="text-center">{{$product->brand->name}}</td>
                            <td class="text-center">{{$product->has_sizes == 0? 'Ne':'Da'}}</td>
                            <td class="text-center">{{$product->gender}}</td>
                            <td class="text-center">
                                @if($product->quantity == 0)rasprodato
                                    @else da
                                @endif
                            </td>
                            <td class="text-center">{{$product->quantity}}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{route('shop.product.details', ['product_slug'=>$product->slug])}}" target="_blank">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{route('admin.product.edit',['id'=>$product->id])}}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{route('admin.product.delete',['id'=>$product->id])}}" method="POST">
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

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                {{ $products -> links('pagination::bootstrap-5') }}
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
                    text: "Da li ste sigurni da želite obrisati izabranu kategoriju?",
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

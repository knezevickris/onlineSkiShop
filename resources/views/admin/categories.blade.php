@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{asset('icon/style.css')}} ">

            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>Kategorije artikala</h3>
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
                                <div class="text-tiny">Kategorije</div>
                            </li>
                        </ul>
                    </div>

                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <a class="tf-button style-1 w208" href="{{route('admin.category.add')}}"><i class="icon-plus"></i>Dodaj novu</a>
                        </div>
                        <div class="wg-table table-all-user">
                            <div class="table-responsive">
                                @if(Session::has('status'))
                                    <p class="alert alert-success">{{Session::get('status')}}</p>
                                @endif
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Naziv</th>
                                        <th>Slug</th>
                                        <th>Proizvodi</th>
                                        <th>Akcije</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $categories as $category )
                                        <tr>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{asset('uploads/categories')}}/{{$category->image}}" alt="{{$category->name}}" class="image">
                                                </div>
                                                <div class="name">
                                                    <p  class="body-title-2" style="padding-top: 20%;">{{$category->name}}</p>
                                                </div>
                                            </td>
                                            <td>{{$category->slug}}</td>
                                            <td>{{$category->products->count()}}</td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <a href="{{route('admin.category.edit', ['id'=>$category->id])}}">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                    <form action="{{route('admin.category.delete',['id'=>$category->id])}}" method="POST">
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
                                {{$categories ->links('pagination::bootstrap-5')}}
                            </div>
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


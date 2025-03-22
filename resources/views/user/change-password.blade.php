@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Promjena lozinke</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Trenutna lozinka</label>
                                <input style="width: 20vw;" type="password" name="current_password" class="form-control" required>
                            </div><br>
                            @error('current-password') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                            <div class="form-group">
                                <label for="new_password">Nova lozinka</label>
                                <input style="width: 20vw;" type="password" name="new_password" class="form-control" required>
                            </div><br>
                            @error('new_password') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                            <div class="form-group">
                                <label for="new_password_confirmation">Potvrdi novu lozinku</label>
                                <input style="width: 20vw;" type="password" name="new_password_confirmation" class="form-control" required>
                            </div><br>
                            @error('new_password_confirmation') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                            <br><br>
                            <button type="submit" class="btn btn-primary">Promijeni lozinku</button>
                        </form>
                    </div><br><br>
                </div>
            </div>
        </section>
    </main>
@endsection

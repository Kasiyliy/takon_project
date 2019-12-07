@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-deck">
                    <div class="card-header">
                        Авторизация
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username"
                                       class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-10">
                                    <input id="username" type="text"
                                           class="form-control  w-100 @error('username') is-invalid @enderror"
                                           name="username"
                                           value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-2 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-10">
                                    <input id="password" type="password"
                                           class="form-control w-100 @error('password') is-invalid @enderror"
                                           name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Войти
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

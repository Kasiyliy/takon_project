@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>Добавить админа</h2>
                        <a class="btn btn-primary btn-sm" href="{{route('user.admins')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('user.admins.store')}}" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{old('username')}}" name="username" class="form-control"
                                       placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{ trans('admin.password') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Подтвердите пароль</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="Подтвердите пароль" required>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Добавить">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
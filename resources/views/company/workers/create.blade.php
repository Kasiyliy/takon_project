@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>Добавить мобильного пользователя</h2>
                        <a class="btn btn-primary btn-sm" href="{{route('company.mobileUsers')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('company.mobileUsers.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control"
                                       placeholder="Имя" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Фамилия</label>
                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control"
                                       placeholder="Фамилия" required>
                            </div>
                            <div class="form-group">
                                <label>Номер телефона</label>
                                <input type="text" value="{{old('username')}}" name="username"
                                       class="form-control"
                                       placeholder="Номер телефона" required>
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
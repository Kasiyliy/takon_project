@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>Изменить пользователя</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('partner.cashiers')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{route('user.updatePassword' ,['id'=>$user->id])}}"
                                      method="post">
                                    <div class="form-group">
                                        <label for="password">Пароль</label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Пароль" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Подтвердите пароль</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Подтвердите пароль" required>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block"
                                               value="Изменить">
                                    </div>
                                </form>
                            </div>
                        </div>
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
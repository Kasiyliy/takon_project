@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>{{ trans('admin.add.user') }}</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('user.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('user.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">{{ trans('admin.first_name') }}</label>
                                <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control" placeholder="{{ trans('admin.first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('admin.last_name') }}</label>
                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control" placeholder="{{ trans('admin.last_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">{{ trans('admin.phone') }}</label>
                                <input type="text" value="{{old('phone_number')}}" name="phone_number" class="form-control" placeholder="{{ trans('admin.phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ trans('admin.password') }}</label>
                                <input type="password" name="password" class="form-control" placeholder="{{ trans('admin.password') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="repassword">{{ trans('admin.confirm.password') }}</label>
                                <input type="password" name="repassword" class="form-control" placeholder="" required>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="{{ trans('admin.add') }}">
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
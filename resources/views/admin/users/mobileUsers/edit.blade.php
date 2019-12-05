@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>{{ trans('admin.edit.user') }}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('user.mobileUsers')}}">{{ trans('admin.back') }}</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{route('user.updatePassword' ,['id'=>$user->id])}}"
                                      method="post">
                                    <div class="form-group">
                                        <label for="name">{{ trans('admin.password') }}</label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="{{ trans('admin.password') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('admin.confirm.password') }}</label>
                                        <input type="password" name="repassword" class="form-control"
                                               placeholder="{{ trans('admin.confirm.password') }}" required>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block"
                                               value="{{ trans('admin.edit') }}">
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
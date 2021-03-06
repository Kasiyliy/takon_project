@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px">
                    <div class="panel-header">
                        <h2>{{ trans('admin.edit.role') }}</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('role.index')}}">{{ trans('admin.back') }}</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('role.update' ,['id'=>$role->id])}}" method="post">
                            <div class="form-group">
                                <label for="name">{{ trans('admin.name') }}</label>
                                <input type="text" value="{{$role->name}}" name="name" class="form-control" placeholder="{{ trans('admin.name') }}" required>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="{{ trans('admin.edit') }}">
                            </div>
                            @if($errors)
                                @foreach($errors->all() as $error)
                                    <p class="m-1 text-danger">{{$error}}</p>
                                @endforeach
                            @endif
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
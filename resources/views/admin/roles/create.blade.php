@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-header">
                        <h2>{{ trans('admin.add.role') }}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('admin.role.index')}}">{{ trans('admin.back') }}</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('admin.role.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">{{ trans('admin.name') }}</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="{{ trans('admin.name') }}" required>
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
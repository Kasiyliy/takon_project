@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px;">
                    <div class="panel-header">
                        <h2>{{ trans('admin.users') }}</h2>
                        <a class="btn btn-success btn-sm" href="{{route('user.create')}}">{{ trans('admin.add') }}</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('admin.first_name') }}</th>
                                    <th>{{ trans('admin.last_name') }}</th>
                                    <th>{{ trans('admin.phone') }}</th>
                                    <th>Email</th>
                                    <th>{{ trans('admin.roles') }}</th>
                                    <th>{{ trans('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td class="d-flex">

                                            @if(!$user->untouchable)
                                            <button type="button" class="btn btn-danger btn-xs mr-1" data-toggle="modal" data-target="#exampleModal{{$user->id}}">
                                                Удалить
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post" action="{{route('user.delete', ['id' => $user->id ])}}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.warning') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ trans('admin.really.delete') }}
                                                                    {{csrf_field()}}


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                                                                <input type="submit" value="{{ trans('admin.delete') }}" class="btn btn-danger btn-sm mr-1">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif


                                            <a href="{{route('user.edit' ,['id'=>$user->id ])}}" class="btn-xs btn btn-primary">{{ trans('admin.edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('datatable')
    @include('layouts.datatable')
@endsection
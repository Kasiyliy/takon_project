@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>Группа: {{$group->name}}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('company.groups')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Пользователи в группе</h3>
                                <table class="table table-hover table-responsive" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Фамилия</th>
                                        <th>Мобильный телефон</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groupUsers as $user)
                                        <tr>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td class="d-flex">
                                                <form action="{{route('company.groups.changeGroup')}}"
                                                      class="btn-xs btn btn-info"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden"
                                                           name="mobile_user_id"
                                                           value="{{$user->mobile_user_id}}">
                                                    <input type="hidden"
                                                           name="group_id"
                                                           value="{{$group->id}}">
                                                    <button class="btn btn-info  btn-xs">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <h3>Пользователи не в группе</h3>
                                <table class="table table-hover table-responsive" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Действия</th>
                                        <th>Имя</th>
                                        <th>Фамилия</th>
                                        <th>Мобильный телефон</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notGroupUsers as $user)
                                        <tr>
                                            <td class="d-flex">
                                                <form action="{{route('company.groups.changeGroup')}}"
                                                      class="btn-xs btn btn-info"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden"
                                                           name="mobile_user_id"
                                                           value="{{$user->mobile_user_id}}">
                                                    <input type="hidden"
                                                           name="group_id"
                                                           value="{{$group->id}}">
                                                    <button class="btn btn-info btn-xs">
                                                        <i class="fa fa-arrow-left"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->phone_number}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
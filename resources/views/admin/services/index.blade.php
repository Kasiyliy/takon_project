@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-header">
                        <h2>Товары/услуги</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Партнер</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Онлайн оплата</th>
                                <th>Цена для онлайн оплат</th>
                                <th>Статус модератора</th>
                                <th>Статус сервиса</th>
                                <th>Создан</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->partner->name}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}</td>
                                    <td>{{$service->online_payment_enabled ? 'Есть' : 'Нет'}}</td>
                                    <td>{{$service->online_payment_price}}</td>
                                    <td>{{$service->moderationStatus->name}}</td>
                                    <td>
                                        {{$service->serviceStatus->name}}
                                    </td>
                                    <td>{{$service->created_at}}</td>
                                    <td>
                                        <form style="margin: 2px"
                                              action="{{route('user.services.accept', ['id' => $service->id])}}"
                                              method="post">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fa fa-check"></i>
                                                Одобрить
                                            </button>
                                        </form>

                                        <form style="margin: 2px"
                                              action="{{route('user.services.reject', ['id' => $service->id])}}"
                                              method="post">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                                Отклонить
                                            </button>
                                        </form>
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
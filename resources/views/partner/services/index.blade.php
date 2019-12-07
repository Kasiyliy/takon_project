@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-header">
                        <h2>Товары/услуги</h2>
                        <a class="btn btn-success btn-sm" href="{{route('partner.services.create')}}">Добавить</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Онлайн оплата</th>
                                <th>Цена для онлайн оплат</th>
                                <th>Статус модератора</th>
                                <th>Статус сервиса</th>
                                <th>Создан</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}</td>
                                    <td>{{$service->online_payment_enabled ? 'Есть' : 'Нет'}}</td>
                                    <td>{{$service->online_payment_price}}</td>
                                    <td>{{$service->moderationStatus->name}}</td>
                                    <td>
                                        <form action="{{route('partner.services.toggleStatus', ['id' => $service->id])}}"
                                              method="post">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-sm btn-link">
                                                <i class="fa fa-hand-o-down"></i>
                                                {{$service->serviceStatus->name}}
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{$service->created_at}}</td>
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
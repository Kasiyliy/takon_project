@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Партнер {{$partner->name}}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('company.services')}}">Назад</a>
                    </div>
                </div>
            </div>
            @foreach($partner->services as $service)
                <div class="col-sm-4">
                    <div class="panel bg-blue">
                        <div class="panel-header">
                            <h2>{{$service->name}}</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Цена: {{$service->price}} таконов
                            </p>
                            <p>
                                Срок годности: {{$service->expiration_days}} дней
                            </p>
                        </div>
                        <div class="panel-footer">
                            <p class="text-primary">
                                Статус: {{$service->serviceStatus->name}}
                            </p>
                            <p class="text-right">
                                <a class="btn-danger btn btn-sm" href="{{route('company.services.makeOrder', ['service_id' => $service->id])}}">Заказать</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
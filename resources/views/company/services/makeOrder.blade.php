@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Сервис: {{$service->name}}</h2>
                        <h2>От партнера: {{$service->partner->name}}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('company.services.details', ['id' => $service->partner_id])}}">Назад</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel  bg-gray">
                    <div class="panel-header">
                        <h2>{{$service->name}}</h2>
                    </div>
                    <div class="panel-body">
                        <p>
                            Цена (за единицу): {{$service->price}} таконов
                        </p>
                        <p>
                            Срок годности: {{$service->expiration_days}} дней
                        </p>

                        <p>
                            Онлайн оплата : {{$service->online_payment_enabled ? 'Включена' : 'Отключена'}}
                        </p>
                        @if($service->online_payment_enabled)
                            <p>Цена в онлайн оплате: {{$service->price}} таконов</p>
                        @endif
                        <p>
                            Статус: {{$service->serviceStatus->name}}
                        </p>
                    </div>
                    <div class="panel-footer">
                        <form action="{{route('company.services.purchase', ['service_id' => $service->id])}}"
                              method="post">
                            <div class="form-group">
                                <input value="{{old('amount')}}" name="amount" type="number" class="form-control"
                                       placeholder="Количество единиц:">
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success"
                                       value="Сделать заказ">
                            </div>
                        </form>

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
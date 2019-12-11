@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Мои заказы услуг</h2>
                    </div>
                </div>
            </div>
            @foreach($companyOrders as $companyOrder)
                <div class="col-sm-4">
                    <div class="panel bg-blue">
                        <div class="panel-header">
                            <h2>{{$companyOrder->service->name}}</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Цена за единицу на момент покупки: {{$companyOrder->actual_service_price}} таконов
                            </p>
                            <p>
                                Количество купленных единиц: {{$companyOrder->amount}}
                            </p>
                            <p>
                                Сумма
                                покупки: {{$companyOrder->formatNumber($companyOrder->amount * $companyOrder->actual_service_price)}}
                                таконов
                            </p>
                        </div>
                        <div class="panel-footer">
                            <p class="text-primary">
                                Статус: {{$companyOrder->orderStatus->name}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
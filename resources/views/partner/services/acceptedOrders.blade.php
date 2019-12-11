@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Заказы моих услуг</h2>
                    </div>
                </div>
            </div>
            @foreach($companyOrders as $companyOrder)
                <div class="col-sm-4">
                    <div class="panel bg-green">
                        <div class="panel-header">
                            <h2>{{"ЮЛ. ".$companyOrder->company->name." заказывает услугу '".$companyOrder->service->name."'"}}</h2>
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
                            <p>
                                Дата заказа: {{$companyOrder->created_at}}
                            </p>
                            <p>
                                Дата принятия
                                услуги: {{$companyOrder->due_date->subDays($companyOrder->service->expiration_days)}}
                            </p>
                            <p>
                                Дата окончания действия услуги: {{$companyOrder->due_date}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
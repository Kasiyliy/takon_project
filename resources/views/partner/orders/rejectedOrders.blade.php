@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Отказанные услуги</h2>
                    </div>
                </div>
            </div>
            @foreach($companyOrders as $companyOrder)
                <div class="col-sm-4">
                    <div class="panel bg-red">
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
                                Дата
                                заказа: {{$companyOrder->created_at}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-sm-12 text-center">
                {{ $companyOrders->links() }}
            </div>
        </div>
    </div>
@endsection
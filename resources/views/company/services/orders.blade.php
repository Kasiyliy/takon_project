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
                    <div class="panel
                        @if($companyOrder->orderStatus->id == \App\OrderStatus::STATUS_WAITING_ID)
                    {{"bg-info"}}
                    @elseif($companyOrder->orderStatus->id == \App\OrderStatus::STATUS_APPROVED_ID)
                    {{"bg-blue"}}
                    @elseif($companyOrder->orderStatus->id == \App\OrderStatus::STATUS_REJECTED_ID)
                    {{"bg-red"}}
                    @endif
                            ">
                        <div class="panel-header">
                            <h2>{{$companyOrder->service->name}}</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Цена за единицу на момент покупки: {{$companyOrder->actual_service_price}} таконов
                            </p>
                            <p>
                                Количество оставшихся единиц: {{$companyOrder->amount}}
                            </p>
                            <p>
                                Количество купленных единиц: {{$companyOrder->initial_amount}}
                            </p>
                            <p>
                                Сумма
                                покупки: {{$companyOrder->formatNumber($companyOrder->initial_amount * $companyOrder->actual_service_price)}}
                                таконов
                            </p>
                        </div>
                        <div class="panel-footer">

                            <a href="{{ route('company.services.send-user', $companyOrder->id) }}">
                                <button class="btn-success btn">Отправить пользователю</button>
                            </a>

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
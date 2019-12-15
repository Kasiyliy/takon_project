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
                    <div class="panel bg-blue">
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
                            <p>
                                Статус: {{$companyOrder->orderStatus->name}}
                            </p>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="{{route('partner.services.ordersAccept', ['id' => $companyOrder->id])}}"
                                          method="post">
                                        {{csrf_field()}}
                                        <input type="submit" class="btn btn-primary" value="Одобрить">
                                    </form>
                                </div>


                                <div class="col-sm-6">
                                    <form action="{{route('partner.services.ordersReject', ['id' => $companyOrder->id])}}"
                                          method="post" class="text-right">
                                        {{csrf_field()}}
                                        <input type="submit" class="btn btn-danger" value="Отказать">
                                    </form>
                                </div>
                            </div>

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
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Мой баланс</h2>
                    </div>
                </div>
            </div>
            @foreach($accountCompanyOrders as $accountCompanyOrder)
                <div class="col-sm-4">
                    <div class="panel bg-blue">
                        <div class="panel-header">
                            <h2>{{"ЮЛ. ".$accountCompanyOrder->companyOrder->company->name." передала вам услугу '".$accountCompanyOrder->companyOrder->service->name."'"}}</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Цена за единицу на момент
                                покупки: {{$accountCompanyOrder->companyOrder->actual_service_price}} таконов
                            </p>
                            <p>
                                Количество переданных единиц: {{$accountCompanyOrder->amount}}
                            </p>
                            <p>
                                Дата передачи: {{$accountCompanyOrder->created_at}}
                            </p>
                            <p>
                                Дата окончания действия услуги: {{$accountCompanyOrder->companyOrder->due_date}}
                            </p>
                            <p>
                                Статус: {{$accountCompanyOrder->accountCompanyOrderStatus->name}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-sm-12 text-center">
                {{ $accountCompanyOrders->links() }}
            </div>
        </div>
    </div>
@endsection
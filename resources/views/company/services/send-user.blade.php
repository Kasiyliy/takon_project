@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-heading">
                        <a  class="btn btn-primary" href="{{route('company.services.orders')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <h2>Сервис: {{$companyOrder->service->name}}</h2>
                        <h3>В наличии: {{$companyOrder->amount}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel  bg-gray">

                    <form action="{{ route('company.services.send-user.store') }}" method="post">

                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="text" name="phone" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="amount">Введите количество</label>
                            <input type="number" name="amount" required class="form-control">
                        </div>
                        @csrf
                        <input type="hidden" name="id" value="{{ $companyOrder->id }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                ОТПРАВИТЬ
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
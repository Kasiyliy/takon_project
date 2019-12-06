@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>Добавить услугу</h2>
                        <a class="btn btn-primary btn-sm" href="{{route('partner.services')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('partner.services.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Наименование</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control"
                                       placeholder="Наименование" required>
                            </div>
                            <div class="form-group">
                                <label>Цена</label>
                                <input type="number" value="{{old('price')}}" name="price"
                                       class="form-control"
                                       placeholder="1000" required>
                            </div>
                            <div class="form-group">
                                <label for="expiration_days">Срок действия в днях</label>
                                <input type="number" value="{{old('expiration_days')}}" name="expiration_days"
                                       class="form-control"
                                       placeholder="Срок действия в днях" required>
                            </div>
                            <div class="form-group">
                                <label for="is_payment_enabled">Онлайн оплата</label>
                                <input type="checkbox" name="is_payment_enabled" class="checkbox">
                                <br>
                            </div>
                            <div class="form-group">
                                <label>Цена для онлайн оплаты</label>
                                <input type="number" name="payment_price" class="form-control"
                                       placeholder="Цена для онлайн оплаты" required>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Добавить">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
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
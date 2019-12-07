@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-body">
                        <h2>Партнеры</h2>

                    </div>
                </div>
            </div>

            @foreach($partners as $partner)
                <div class="col-sm-4">
                    <div class="panel bg-blue">
                        <div class="panel-header">
                            <h2>{{$partner->name}}</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Партнер имеет {{$partner->services->count()}} сервисов
                            </p>
                        </div>
                        <div class="panel-footer">
                            <a href="{{route('company.services.details', ['id' => $partner->id])}}"
                               class="btn btn-block bg-primary">Посмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
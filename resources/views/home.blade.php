@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <section class="content">
                ТАКОН
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('admin/bower_components/chartjs/chart.js')}}"></script>

    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

    </style>


@endsection
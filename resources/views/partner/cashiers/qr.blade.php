@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px">
                    <div class="panel-header">
                        <h2>QR {{ $user->cashier->name }}</h2>
                        <a class="btn btn-primary btn-sm"
                           href="{{route('partner.cashiers')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12"><?php
	                            use chillerlan\QRCode\QRCode;
	                            $qr = new QRCode();

	                            echo '<img width="400" height="400" src="'.$qr->render($user->cashier->token_hash).'" />';

	                            ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
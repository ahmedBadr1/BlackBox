@extends('seller.layouts.seller')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <h1 class="text-center main-content-title">{{ __('names.price-list') }}</h1>
            <p  class="text-center">{{ __('messages.price-list') }}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-semibold tx-15">How To Insert All The Plugins?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
                <div class="card-body ">
                    <h4 class="font-weight-semibold tx-15">How Can I contact?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
                <div class="card-body">
                    <h4 class="font-weight-semibold tx-15">Can I use this Plugins in Another Template?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
                <div class="card-body ">
                    <h4 class="font-weight-semibold tx-15">How Can I Add another page in Template?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
                <div class="card-body">
                    <h4 class="font-weight-semibold tx-15">It is Easy to Customizable?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
                <div class="card-body ">
                    <h4 class="font-weight-semibold tx-15">How can I download This template?</h4>
                    <p class="text-muted mb-0 tx-13">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                </div>
            </div>
        </div>
    </div>



@endsection

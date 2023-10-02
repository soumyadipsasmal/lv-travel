@extends('front.app')
@section('main_content')
    <style>
        input.razorpay-payment-button {
            background: red;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 5px
        }
    </style>
    <div class="container py-5">
        @if (Session::has('success'))
            <div class="alert alert-success text-center mt-2">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('Error'))
            <div class="alert alert-danger mt-2">
                {{ Session::get('Error') }}
            </div>
        @endif
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Invoice</h6>
            </div>
            <div class="pull-right">
                <h6 class="txt-dark">Order: #{{ $tourdata->bookingid }}</h6>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="seprator-block mb-5"></div>

        <div class="row ">
            <div class="col-md-6">
                <span class="txt-dark head-font inline-block capitalize-font mb-5">Billed to: <b>
                        @if (isset($cdata->caddress))
                            {{ $cdata->caddress }}
                        @else
                            {{ Auth::User()->address }}
                        @endif
                    </b>
                    <address class="mb-15">
                        <abbr title="Phone">P:@if (isset($cdata->cnumber))
                                {{ $cdata->cnumber }}
                            @else
                                {{ Auth::User()->contact }}
                            @endif
                    </address>
            </div>
            <div class="col-md-6 text-right">

            </div>
        </div>
        <div class="row">

            <div class="col-md-6 text">
                <address>
                    <span class="txt-dark head-font capitalize-font mb-5">Order Date:</span><br>
                    {{ $tourdata->created_at }}<br><br>
                </address>
            </div>
        </div>
        <div class="seprator-block mb-5"></div>
        <div class="invoice-bill-table">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Tour Members</th>
                            <th>Members Name</th>
                            <th>Members Number</th>
                            <th>Tour Place</th>
                            <th>Tour Start</th>
                            <th>Tour Duration</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $bookingdata->name }}</td>
                            <td>{{ $bookingdata->email }}</td>
                            <td> {{ $bookingdata->tgroup }} </td>
                            <td> {{ $bookingdata->pnames }} </td>
                            <td> {{ $bookingdata->pcontact }} </td>
                            <td> {{ $tourdata->tour_place }} </td>
                            <td> {{ $tourdata->tour_start }} </td>
                            <td> {{ $tourdata->tour_duration }} days </td>
                            <td>₹{{ number_format($bookingdata->total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pull-right d-flex align-items-center justify-content-center" style="gap:10px">
                <form action="{{ route('pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="orderid" value="{{ $tourdata->bookingid }}">
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="{{ $bookingdata->total * 100 }}" data-buttontext="Proceed to payment" data-name="Lv-Travel"
                        data-description="Order Data"
                        data-image="https://laraveltuts.com/wp-content/uploads/2022/08/laraveltuts-rounde-logo.png" data-prefill.name="name"
                        data-prefill.email="email" data-theme.color="#ff7529"></script>
                </form>


            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

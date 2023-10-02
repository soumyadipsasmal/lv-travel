@extends('front.app')
@section('main_content')
    <div class="container py-5">
        @if (Session::has('success'))
            <div class="alert alert-success text-center mt-2">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger mt-2">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="container mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="text-left logo p-2 px-5">
                            <img src="" width="50">
                        </div>
                        <div class="invoice p-5">
                            <h5>Your Booking Confirmed!</h5>
                            <span class="font-weight-bold d-block mt-4">Hello, {{ $bookingdata->name }}</span>
                            <span>You Booking has been confirmed and will be inform you further detalis in next two
                                days!</span>
                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Booking Date</span>
                                                    <span>{{ $paymentdetails->created_at }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Bokking No</span>
                                                    <span>{{ $paymentdetails->orderid }}</< /span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Payment</span>
                                                    <span><img src="https://badges.razorpay.com/badge-dark.png "
                                                            width="60" /></span>
                                                </div>
                                            </td>
                                            {{--  <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Shiping Address</span>
                                                    <span>414 Advert Avenue, NY,USA</span>
                                                </div>
                                            </td>  --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td width="20%">
                                                <img src="{{ asset('storage/' . $tourdata->tour_image) }}" width="90">
                                            </td>
                                            <td width="60%">
                                                <span class="font-weight-bold">{{ $tourdata->tour_place }}</span>
                                                <div class="product-qty">
                                                    <span class="d-block">Tour Duration:
                                                        {{ $tourdata->tour_duration }} Days</span>
                                                </div>
                                                <div class="product-qty">
                                                    <span class="d-block">Tour Start:
                                                        {{ date($tourdata->tour_start) }}</span>
                                                </div>
                                                <div class="product-qty">
                                                    <span class="d-block">Total Members: {{ $bookingdata->tgroup }}</span>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                <div class="text-right">
                                                    <span class="font-weight-bold">
                                                        ₹{{ number_format($tourdata->tour_price) }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Subtotal</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span> ₹{{ number_format($paymentdetails->amount) }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>We will be sending Booking confirmation email</p>
                            <p class="font-weight-bold mb-0">Thanks for Choosing us!</p>
                            <span>Team Tour and Travel</span>
                        </div>
                        <button type="button" class="btn btn-success btn-outline btn-icon left-icon mx-auto"
                            onclick="javascript:window.print();" style="width:100px">
                            <i class="fa fa-print"></i><span> Print</span>
                        </button>
                        <div class="d-flex justify-content-between footer p-3">
                            <span>Need Help? visit our <a href="#"> help center</a></span>
                            <span>{{ $paymentdetails->created_at }}</< /span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a class="btn btn-primary text-white" href="{{ route('home') }}">Back To Home</a>
                    </div>
                </div>

            </div>
        </div>
    @endsection

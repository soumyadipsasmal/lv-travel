@extends('front.app')
@section('main_content')
    <div class="container">
        <h3 class="pt-3 pb-1">Book Your Tour</h3>
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
        <div class="row mt-3">
            <div class="col-md-6 mt-3">
                <form action="" method="post" id="form">
                    @csrf
                    <input type="hidden" name="tourid" value="{{ $tourdata->id }}">
                    <input type="hidden" name="bid" value="{{ $bid }}" id="bid" />
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name"> Name</label>
                            <input type="text" class="form-control" name="cname" id="cname"
                                aria-describedby="emailHelp" placeholder="Enter Name"
                                value="@if (isset(Auth::user()->name)) {{ Auth::user()->name }}@else{{ old('cname') }} @endif">
                            @error('cname')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> Email</label>
                            <input type="email" class="form-control" name="cemail" id="email"
                                aria-describedby="emailHelp" placeholder="Enter email"
                                value="@if (isset(Auth::user()->email)) {{ Auth::user()->email }}@else{{ old('cemail') }} @endif">
                            @error('cemail')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="number" class="form-control" name="cnumber" id="number"
                                aria-describedby="emailHelp" placeholder="Enter Number" value="{{ old('cnumber') }}">
                            @error('cnumber')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" name="caddress" id="caddress"
                                aria-describedby="emailHelp" placeholder="Enter Address" value="{{ old('caddress') }}">
                            @error('caddress')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Tour Members</label>
                            <input type="number" class="form-control" name="tgroup" id="tgroup"
                                aria-describedby="emailHelp" placeholder="Enter Tour Member" value="{{ old('tgroup') }}">
                            @error('tgroup')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="grrperson" class="col-md-12"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                @if (isset($tourdata))
                    <div class="subject-card mt-lg-0 mt-4 mb-4">
                        <div class="subject-card-header p-4">
                            <a href="{{ route('tourdetails', $tourdata->id) }}" class="card_title p-lg-3 d-block">
                                <div class="row align-items-center">
                                    <div class="col-sm-5 subject-img">
                                        @if ($tourdata->tour_image)
                                            <img src="{{ asset('storage/' . $tourdata->tour_image) }}" class="img-fluid"
                                                alt="">
                                        @else
                                            <img src=" front-assets\images\g1.jpg " class="img-fluid" alt="">
                                        @endif
                                    </div>
                                    <div class="col-sm-7 subject-content mt-sm-0 mt-4">
                                        <h4 class="pb-2">{{ $tourdata->tour_name }}</h4>
                                        <p class="pb-2">{{ $tourdata->tour_duration }} Days</p>
                                        <div class="dst-btm">
                                            <h6 class=""> Start From- {{ $tourdata->tour_start }} </h6>
                                            <span class="pt-3">₹{{ $tourdata->tour_price }}/- Per Person</span>
                                            <h5 class="pt-2 text-primary">Total Seat: {{ $tourdata->tour_group }} Persons
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="mt-4 d-flex justify-content-center align-center" style="" id="cont">
                                <i id="text" class="text-right w-100 h4 py-1 text-info font-weight-bolder"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tgroup").keyup(function() {
                let mxp = "{{ $tourdata->tour_group }}"
                let price = "{{ $tourdata->tour_price }}"
                if ($(this).val() > parseInt(mxp)) {
                    text.innerHTML = '';
                    $('#text').removeAttr("style");
                    $(this).val('')
                    $('#grrperson').empty()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `Max ${mxp} Person Allow`,
                    })
                } else if ($(this).val() <= parseInt(mxp)) {
                    $('#grrperson').empty()
                    let text = document.getElementById('text');
                    let total = eval($(this).val() * parseInt(price))
                    text.innerHTML = `Total Price: ₹${total}`;
                    $('#text').css({
                        "border-top": "2px solid black"
                    });
                    if ($(this).val() === '') {
                        text.innerHTML = '';
                        $('#text').removeAttr("style");
                    }
                    for (let i = 1; i <= parseInt($(this).val()); i++) {
                        $('#grrperson').append(`<div class="row" >
                            <div class="form-group col-md-6">
                                <label for="name"> Name</label>
                                <input type="text" class="form-control" name="pnames[]" id="name"
                                    aria-describedby="emailHelp" placeholder="Enter Name"
                                    value="">
                                @error('pname')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> Number</label>
                                <input type="number" class="form-control" name="pcontact[]" id="pcontact"
                                    aria-describedby="emailHelp" placeholder="Enter number"
                                    value="">
                                @error('pnumber')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>`)
                    }
                } else {
                    $('#grrperson').empty()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `Max ${mxp} Person Allow`,
                    })
                }
            })
        })
    </script>
    {{--  //ajax validation  --}}
    <script>
        @if (!Auth::check())
            $(document).ready(function() {
                $('#form').change(function() {
                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{ route('customerChecking') }}',
                        data: $('#form').serialize(),
                        dataType: 'json',
                        success: function(data) {
                            if (data.res === 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: `${data.msg}`,
                                });
                                $('.btn-primary').prop('disabled', true)
                            } else {
                                $('.btn-primary').prop('disabled', false)
                            }
                        }
                    })
                })
            })
        @endif
    </script>
    {{--  form submit  --}}
    <script>
        $('#form').submit(function(e) {
            const bid = $('#bid').val()
            e.preventDefault();
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{ route('booking.store') }}',
                data: $('#form').serialize(),
                success: function(data) {
                    if (data.res === 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thank You!',
                            text: `${data.msg}`,
                        }).then(function() {
                            window.location = '{{ route('order.details', $bid) }}'
                        });
                        $('#form')['0'].reset();
                    } else {}
                }
            })
        });
    </script>
@endsection

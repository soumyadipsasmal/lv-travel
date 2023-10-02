@extends('front.app')
@section('main_content')
    <section class="w3l-about-breadcrumb text-left mt-0">
        <div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-5">
            <div class="container">
                <h2 class="title">Categories - @if (isset($catdata->catname))
                        {{ $catdata->catname }}
                    @endif Tour </h2>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ URL('/') }}">Home</a></li>
                    <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span>
                        @if (isset($catdata->catname))
                            {{ $catdata->catname }}
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="grids-1 py-5">
        <div class="grids py-lg-3 py-md-3">
            <div class="container">
                <h3 class="hny-title mb-5">Destinations</h3>
                <div class="row">
                    @if (isset($tourdata) && count($tourdata) > 0)
                        @foreach ($tourdata as $tour)
                            <div class="col-lg-6 col-md-6 col-6">
                                <a href="{{ route('tourdetails', $tour->id) }}" class="card_title p-lg-4d-block">
                                    <div class="row align-items-center">
                                        <div class="col-sm-5 subject-img">
                                            @if ($tour->tour_image)
                                                <img src="{{ asset('storage/' . $tour->tour_image) }}" class="img-fluid"
                                                    alt="">
                                            @else
                                                <img src=" front-assets\images\g1.jpg " class="img-fluid" alt="">
                                            @endif
                                        </div>
                                        <div class="col-sm-7 subject-content mt-sm-0 mt-4">
                                            <h4>{{ $tour->tour_name }}</h4>
                                            <p>{{ $tour->tour_duration }} Days</p>
                                            <div class="dst-btm">
                                                <h6 class=""> Start From </h6>
                                                <span>${{ $tour->tour_price }}</span>
                                            </div>
                                            <p class="sub-para">Per person</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="column">
                                No Tours Found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

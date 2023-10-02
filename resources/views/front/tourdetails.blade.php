@extends('front.app')
@section('main_content')
    <div class="container mt-5 mb-5">

        <div class="row">
            @if (isset($tourdata))
                @foreach ($tourdata as $tour)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $tour->tour_image) }}" alt="" class="img img-fluid">
                    </div>
                    <div class="col-md-9">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tour Name</th>
                                    <th> Place</th>
                                    <th> Price</th>
                                    <th> Category</th>
                                    <th>Tour Start</th>
                                    <th> Duration</th>
                                    <th>Tour Group</th>
                                    <th>Tour Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $tour->tour_name }}</td>
                                    <td>{{ $tour->tour_place }}</td>
                                    <td>{{ number_format($tour->tour_price) }}</td>
                                    <td>{{ $tour->catname }}</td>
                                    <td>{{ $tour->tour_start }}</td>
                                    <td>{{ $tour->tour_duration }}</td>
                                    <td>{{ $tour->tour_group }}</td>
                                    <td>{{ $tour->tour_description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('bookings', $tour->id) }}" class="btn btn-primary text-center" >Book Now</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

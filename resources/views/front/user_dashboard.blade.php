<x-app-layout>

</x-app-layout>
<!DOCTYPE html>
<html>

<head>
    <title>All Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-QV7bN3Nw90V7jKo+bpx8iKZMsz9Z4x4q3U5km6Dv1Y0Ry6oHwolW7/8oOvWhXfNpC5BZlNcAxGImeOoUGbH2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center my-4">All Bookings</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tour Image</th>
                                <th>Tour Name</th>
                                <th>Tour Start</th>
                                <th>Tour Duration</th>
                                <th>Total Members</th>
                                <th> Members Name</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            @endphp
                            @if (isset($bookingdata))
                                @foreach ($bookingdata as $booking)
                                    <tr class="align-middle text-center">
                                        <td>{{ $booking->bid }}</td>
                                        <td class="col-md-1"><img src="{{ asset('storage/' . $booking->tour_image) }}"
                                                alt="" class="img img-thumbnail">
                                        </td>
                                        <td>{{ $booking->tour_name }}</td>
                                        <td>{{ $booking->tour_start }}</td>
                                        <td>{{ $booking->tour_duration }} Days</td>
                                        <td>{{ $booking->tgroup }} </td>
                                        <td>{{ $booking->pnames }} </td>
                                        <td>₹{{ number_format($booking->total) }}</td>
                                        <td>
                                            @if ($booking->status == 0)
                                                <span class="badge bg-danger text-dark">Failed</span>
                                            @elseif($booking->status == 1)
                                                <span class="badge bg-blue text-dark">panding</span>
                                            @elseif($booking->status == 2)
                                                <span class="badge bg-primary text-white">Approve</span>
                                            @elseif($booking->status == 3)
                                                <span class="badge bg-success text-white">Complete</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

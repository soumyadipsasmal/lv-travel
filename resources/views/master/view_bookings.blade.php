@extends('master.app')
@section('main_content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('Error'))
        <div class="alert alert-success">
            {{ Session::get('Error') }}
        </div>
    @endif
    <h4 class="mb-2" style="padding-bottom: 10px">All Booking Details</h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table display responsive product-overview mb-30 dataTable no-footer"
                                        id="myTable" role="grid" aria-describedby="myTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width:103px;">Booking ID</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width: 159px;">
                                                    Coustomer Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width:
                                                    117px;">
                                                    Coustomer Number</th>
                                                <th class="sorting_asc" aria-sort="ascending" style="width: 159px;">
                                                    Coustomer Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width: 155px;">Tour ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width: 92px;">Total Members</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width:
                                                    105px;">
                                                    Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width: 105px;">Total Price</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width: 80px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="myTable"
                                                    style="width: 82px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($bookingdata))
                                                @foreach ($bookingdata as $booking)
                                                    <tr role="row" class="odd">
                                                        <td class="txt-dark">#{{ $booking->bid }}</td>
                                                        <td class="txt-dark sorting_1">{{ $booking->name }}</td>
                                                        <td>
                                                            @if (isset($booking->cnumber))
                                                                {{ $booking->cnumber }}
                                                            @else
                                                                {{ $booking->contact }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $booking->email }}</td>
                                                        <td>{{ $booking->tourid }}</td>
                                                        <td>{{ $booking->tgroup }}</td>
                                                        <td>{{ $booking->created_at }}</td>
                                                        <td>{{ number_format($booking->total) }}</td>
                                                        <td>
                                                            @if ($booking->status == 0)
                                                                <span class="badge badge-danger">Failed</span>
                                                            @elseif ($booking->status == 1)
                                                                <span class="badge badge-muted">Pending</span>
                                                            @elseif ($booking->status == 2)
                                                                <span class="badge badge-primary">Approve</span>
                                                            @elseif ($booking->status == 3)
                                                                <span class="badge badge-success">Complete</span>
                                                            @else
                                                                <span class="badge badge-danger disabled"> Something Went
                                                                    Wrong
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('bookings.edit', $booking->id) }}"
                                                                class="text-inverse pr-10" title=""
                                                                data-toggle="tooltip" data-original-title="Edit"><i
                                                                    class="zmdi zmdi-edit txt-warning"></i></a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-original-title="Close"
                                                                onclick="handleClick('{{ route('bookings.delete', $booking->id) }}')">
                                                                <i class="fa fa-close text-danger"></i> </a>
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
                </div>
                <div class="ok" style="display:flex;justify-content:flex-end">
                    {{ $bookingdata->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <form id="deleteform" method="post">
        @method('DELETE')
        @csrf
    </form>
    <script type="text/javascript">
        const handleClick = (id) => {
            var delForm = document.getElementById("deleteform");
            delForm.action = id;
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById("deleteform").submit();
                    }
                });
        }
    </script>
@endsection

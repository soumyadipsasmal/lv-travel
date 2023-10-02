@extends('master.app')
@section('main_content')
    <div class="row container-fluid">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Tour Category</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admindashboard') }}">Dashboard</a></li>
                    <li class="active"><span>Categories</span></li>
                </ol>
            </div>
        </div>
        <div class="col-md-12" style="padding: 0px">
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
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Category Table</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>SL No</th>
                                                <th>Tour Image</th>
                                                <th>Tour Name</th>
                                                <th>Tour Place</th>
                                                <th>Tour Price</th>
                                                <th>Tour Category</th>
                                                <th>Tour Start</th>
                                                <th>Tour Duration</th>
                                                <th>Tour status</th>
                                                <th>Tour Group</th>
                                                <th>Tour Description</th>
                                                <th class="text-nowrap">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @if (isset($tourdata))
                                                @foreach ($tourdata as $tour)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td class="col-md-2">
                                                            @if (!empty($tour->tour_image))
                                                                <img src="{{ asset('storage/' . $tour->tour_image) }}"
                                                                    alt="" class="img img-thumbnail">
                                                            @endif
                                                        </td>
                                                        <td>{{ $tour->tour_name }}</td>
                                                        <td>{{ $tour->tour_place }}</td>
                                                        <td>{{ number_format($tour->tour_price) }}</td>
                                                        <td>{{ $tour->catname }}</td>
                                                        <td>{{ $tour->tour_start }}</td>
                                                        <td>{{ $tour->tour_duration }}</td>
                                                        <td>
                                                            @if ($tour->tour_status == 1)
                                                                <span class="badge badge-success">Activce</span>
                                                            @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        <td>{{ $tour->tour_group }}</td>
                                                        <td>{{ $tour->tour_description }}</td>
                                                        <td class="text-nowrap"><a
                                                                href="{{ route('tours.edit', $tour->id) }}" class="mr-25"
                                                                data-toggle="tooltip" data-original-title="Edit"> <i
                                                                    class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-original-title="Close"
                                                                onclick="handelClick('{{ route('tours.destroy', $tour->id) }}')">
                                                                <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="ok" style="display:flex;justify-content:flex-end">
                                        {{ $tourdata->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        function handelClick(deleteurl) {
            var delForm = document.getElementById("deleteform");
            delForm.action = deleteurl;
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

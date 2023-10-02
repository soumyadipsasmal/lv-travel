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
            <div class="col-md-5">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            @if (isset($category->id))
                                <h6 class="panel-title txt-dark">Edit A Category</h6>
                            @else
                                <h6 class="panel-title txt-dark">Add A Category</h6>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if (isset($category->id))
                        <form class="panel-body" action="{{ route('category.update', $category->id) }}" method="post"
                            enctype="multipart/form-data" id="#form">
                            @method('PUT')
                        @else
                            <form class="panel-body" action="{{ route('category.store') }}" method="post"
                                enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">Category</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="catname"
                            value="@if (isset($category->catname)) {{ $category->catname }}@else{{ old('catname') }}@endif">
                        @error('catname')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">Slug Name </label>
                        <input type="text" id="example-email" name="catslug" class="form-control" placeholder="Slug Name"
                            value="@if (isset($category->catslug)){{ $category->catslug }}@else{{ old('catslug') }}@endif">
                        @error('catslug')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">Image</label>
                        <input type="file" class="form-control" name="catimage">
                        @error('catimage')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
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
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Slug</th>
                                                <th class="text-nowrap">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @if (isset($catdata))
                                                @foreach ($catdata as $cat)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $cat->catname }}</td>
                                                        <td>
                                                            @if (!empty($cat->catimage))
                                                                <img src="{{ asset('storage/' . $cat->catimage) }}"
                                                                    alt="" class="img img-thumbnail">
                                                            @endif
                                                        </td>
                                                        <td>{{ $cat->catslug }}</td>
                                                        <td class="text-nowrap"><a
                                                                href="{{ route('category.edit', $cat->id) }}"
                                                                class="mr-25" data-toggle="tooltip"
                                                                data-original-title="Edit"> <i
                                                                    class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-original-title="Close"
                                                                onclick="handelClick('{{ route('category.destroy', $cat->id) }}')">
                                                                <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="ok" style="display:flex;justify-content:flex-end">
                                        {{ $catdata->links() }}
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

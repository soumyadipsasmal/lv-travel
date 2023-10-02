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
                            @if (isset($tour->id))
                            <h6 class="panel-title txt-dark">Edit A Tour</h6>
                            @else
                            <h6 class="panel-title txt-dark">Add A Tour</h6>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if (isset($tour->id))
                    <form class="panel-body" action="{{ route('tours.update',$tour->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                    <form class="panel-body" action="{{ route('tours.store') }}" method="post"
                        enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">Select Tour Category</option>
                                    @if (isset($catdata))
                                        @foreach ($catdata as $cat)
                                            <option value="{{$cat->id}}"
                                                @if(isset($tour->cat_id) && $tour->cat_id==$cat->id ){{__('selected')}}
                                                @endif>{{ $cat->catname }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('cat_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Name </label>
                                <input type="text" id="example-email" name="tour_name" class="form-control"
                                    placeholder="Tour Name" value="@if(isset($tour->tour_name)){{$tour->tour_name}}@else{{old('tour_name')}}@endif">
                                @error('tour_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Price </label>
                                <input type="number" id="example-email" name="tour_price" class="form-control"
                                    placeholder="Tour Price" value="@if(isset($tour->tour_start)){{$tour->tour_price}}@else{{old('tour_price')}}@endif">
                                @error('tour_price')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Start </label>
                                <input type="date" id="example-email" name="tour_start" class="form-control"
                                    value="@if(isset($tour->tour_start)){{$tour->tour_start}}@else{{old('tour_start')}}@endif">
                                @error('tour_start')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Duration </label>
                                <input type="text" id="example-duration" name="tour_duration" class="form-control"
                                    placeholder="Tour Duration" value="@if(isset($tour->tour_duration)){{$tour->tour_duration}}@else{{old('tour_duration')}}@endif">
                                @error('tour_duration')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Image</label>
                                <input type="file" class="form-control" name="tour_image">
                                @error('tour_image')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Group </label>
                                <input type="number" id="example-group" name="tour_group" class="form-control"
                                    placeholder="Tour Group" value="@if(isset($tour->tour_group)){{$tour->tour_group}}@else{{old('tour_group')}}@endif">
                                @error('tour_group')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Place </label>
                                <input type="text" id="example-place" name="tour_place" class="form-control"
                                    placeholder="Tour Place" value="@if(isset($tour->tour_place)){{$tour->tour_place}}@else{{old('tour_place')}}@endif">
                                @error('tour_place')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if(isset($tour->tour_status))
                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Status</label>
                                <select name="tour_status" id="tour_status" class="form-control" required>
                                    <option  value="">Select Status</option>
                                    <option  value="1" @if($tour->tour_status==1){{ __('selected')}}@endif >Active</option>
                                    <option  value="0" @if($tour->tour_status==0){{ __('selected')}}@endif >Inactive</option>
                                </select>
                            </div>
                            @endif

                            <div class="form-group col-md-6">
                                <label class="control-label mb-10 text-left">Tour Description </label>
                                <textarea id="example-des" name="tour_description" class="form-control" placeholder="Tour Description">@if(isset($tour->tour_description)){{$tour->tour_description}}@else{{old('tour_description')}}@endif</textarea>
                                @error('tour_description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12" style="display:flex; align-items:center; justify-content:center"><button
                                class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
@endsection

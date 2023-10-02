@extends('master.app')
@section('main_content')
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Edit Bookings</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form action="{{ route('bookings.update', $bookingdata->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Coustomer Name</label>
                                <input type="text" class="form-control" value="{{ $bookingdata->name }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left" for="example-email">Email </label>
                                <input type="email" id="example-email" name="example-email" class="form-control"
                                    placeholder="Email" value="{{ $bookingdata->email }}">
                            </div>
                            <div class="form-group mt-30 mb-30">
                                <label class="control-label mb-10 text-left">select</label>
                                <select class="form-control" name="status">
                                    <option>Select From Here</option>
                                    <option value="0" @if ($bookingdata->status === 0) selected @endif>
                                        Failed</option>
                                    <option value="1" @if ($bookingdata->status === 1) selected @endif>
                                        Pending</option>
                                    <option value="2" @if ($bookingdata->status === 2) selected @endif>
                                        Approve</option>
                                    <option value="3" @if ($bookingdata->status === 3) selected @endif>
                                        Complete</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

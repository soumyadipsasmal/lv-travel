@extends('master.app')
@section('main_content')
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Update Your Profile</h5>
            </div>
            <!-- Breadcrumb -->

            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Basic Form</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form action="{{ route('adminprofile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">Name</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            name="name" id="name">
                                        @error('name')
                                            <div class="invalid-feedback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="profile">Profile Image
                                        </label>
                                        <input type="file" id="profile" name="profile" class="form-control">
                                        @error('profile')
                                            <div class="invalid-feedback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

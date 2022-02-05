@extends('back-end.layouts.master')
@section('dashboard')
    active
@endsection
@section('main-content')
<div class="container-fluid dashboard-content ">
    <div class="row">

        <!-- ============================================================== -->
        <!-- end total views   -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- total followers   -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Doctor</h5>
                         <h2 class="mb-0"> {{ $doctors }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end total followers   -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- partnerships   -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Patients</h5>
                         <h2 class="mb-0">{{ $patients }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end total earned   -->
        <!-- ============================================================== -->
    </div>
</div>
@endsection

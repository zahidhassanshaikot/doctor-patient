<!-- msater layout -->
@extends('back-end.layouts.master')
<!-- active menu -->

@section('doctor-list')
    active
@endsection

@section('main-content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->

                <div class="admin-section">
                    <div class="row clearfix m-t-30">
                        <div class="col-12">
                            <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-12">
                                            @if(session('error'))
                                                <div id="error_m" class="alert alert-danger">
                                                    {{session('error')}}
                                                </div>
                                            @endif
                                            @if(session('success'))
                                                <div id="success_m" class="alert alert-success">
                                                    {{session('success')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="block-header col-6">
                                            <h2>{{ __('Doctors') }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone No') }}</th>
                                            <th>{{ __('Reg No') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Option') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)

                                            <tr role="row" id="row_{{ $user->id }}" class="odd">
                                                <td class="sorting_1">{{ $user->id}}</td>

                                                <td>{{ $user->name}}
                                                    @if($user->doctor==1)
                                                        <small class="text-success">({{ __('doctor') }})</small>
                                                    @endif
                                                    @if($user->admin==1)
                                                        <small class="text-success">({{ __('admin') }})</small>
                                                    @endif
                                                </td>
                                                <td> {{$user->email}}</br> </td>
                                                <td> {{$user->phone_no}}</br> </td>
                                                <td> {{$user->reg_no}}</br> </td>
                                                <td>
                                                    @if($user->approve==0)
                                                        <small class="text-warning">({{ __('Not Approved') }})</small>
                                                    @else
                                                        <small class="text-success">({{ __('Approved') }})</small>
                                                    @endif
                                                </td>
                                                <td>
                                                        @if($user->doctor==1 )
                                                            @if( $user->approve==0 )
                                                                <a href="{{ route('approve',['id'=>$user->id]) }}"class="text-success">
                                                                    <i class="fa fa-check option-icon"></i>
                                                                        {{ __('Approve') }}
                                                                    </a>
                                                            @else
                                                                <a href="{{ route('not-approve',['id'=>$user->id]) }}"class="text-danger">
                                                                    <i class="fa fa-ban option-icon"></i>
                                                                    {{ __('Not Approve') }}
                                                                </a>
                                                            @endif
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- page info end-->
        </div>
    </div>
@endsection

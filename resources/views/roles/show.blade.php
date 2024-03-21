@extends('layouts.admin.master')
@section('title')
    Role Details
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>View  Role</h1>
        @endslot
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start">
                    <h3>Role Details</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
                <div class="col-md-5 my-2">
                    <div class="section-header-breadcrumb py-1  dropdown-basic">
                        <a href="{{ route('roles.edit',$role->id) }}" class="btn dropbtn btn-secondary btn-round"> <i
                                class="fa fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
    @include('layouts.admin.partials.flash-message')
    <section class="section">

        <div class="container-fluid">
            <div class="row starter-main">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="details-tab" data-target="#details" data-bs-toggle="tab"
                                       href="#details" role="tab"
                                       aria-controls="details" aria-selected="false">Details</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered">
                                <div class="tab-pane fade active show" id="details" role="tabpanel"
                                     aria-labelledby="details-tab">
                                    <div class="d-flex flex-wrap my-2 wrap-col-rev-450">
                                        <div class="col-12">
                                            <div id="editable">
                                            {{ html()->form('PATCH', 'roles.update')->open() }}
                                                @include('roles.show_fields')
                                                <div class="float-end fst-italic lighter-link"><a href="{{route('auditLog', array('model' => get_class($role), 'id' => $role->id ))}}" class="text-secondary fw-normal">Audit Log</a></div>
                                            {{ html()->form()->close() }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

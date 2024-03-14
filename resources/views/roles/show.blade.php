@extends('layouts.admin.master')
@section('title')
    Role Details
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>View  Role</h1>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                Home
            </a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item">View Role</li>

        @slot('page_options')
            <div class="section-header-breadcrumb py-1  dropdown-basic">
                <a href="{{ route('roles.edit',$role->id) }}" class="btn dropbtn btn-secondary btn-round"> <i
                        class="fa fa-edit"></i> Edit</a>
            </div>
        @endslot
    @endcomponent
    <section class="section">

        {{--        @include('layouts.errors')--}}
        <div class="section-body">
            <div class="recordNavWrapper"></div>
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
                                <div class="col-10">
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
    </section>
@endsection

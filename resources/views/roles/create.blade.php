@extends('layouts.admin.master')
@section('title')
    Create Role
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>Create New Role</h1>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                Home
            </a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item">Create New Role</li>

        @slot('page_options')
            <div class="section-header-breadcrumb my-2 dropdown-basic">
                <a href="{{ route('roles.index') }}" class="btn dropbtn btn-secondary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
        @endslot
    @endcomponent
    <section class="section">
        <div class="content">
{{--            @include('layouts.errors')--}}
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {{ html()->form('POST', route('roles.store'))->open() }}
                                    <div class="row">
                                        @include('roles.fields')
                                    </div>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


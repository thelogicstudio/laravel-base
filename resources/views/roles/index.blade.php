@extends('layouts.admin.master')
@section('title')
    Roles
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start">
                    <h3>Roles</h3>
                </div>
                <div class="col-md-5 my-2">
                    @can('create', \App\Models\Role::class)
                        <div class="add-btn">
                            <a href="{{ route('roles.create') }}" class="btn btn-secondary mt-1 form-btn">New Role<i
                                    class="fa fa-plus ms-2"></i></a>
                        </div>
                    @endcan
                </div>
            </div>
        @endslot
    @endcomponent
    @include('layouts.admin.partials.flash-message')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('roles.table')
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin.master')
@section('title')
  User Details
@endsection

@section('content')
@component('components.breadcrumb')
        @slot('breadcrumb_title')
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                Home
            </a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item">View </li>
        @slot('page_options')
            @can('delete', $user)
                <div class="section-header-breadcrumb py-1 mt-1 dropdown-basic">
                    <a class='btn btn-danger item-delete' data-bs-toggle="modal" data-id="{{$user->id}}" data-link="/users/destroy/{{$user->id}}" data-bs-target="#deleteModal" title="Delete Contact" href="#">
                        <i class="fa fa-trash-o"></i> Delete</a>
                </div>
            @endcan
            @can('update', $user)
                <div class="section-header-breadcrumb py-1 mt-1 dropdown-basic">
                    <a class='btn btn-secondary btn-edit' href="{{route('users.edit', $user->id)}}"><i
                            class="fa fa-edit"></i> Edit</a>
                </div>
            @endcan
            <div class="section-header-breadcrumb py-1 mt-1 dropdown-basic">
                <a href="{{ Session::get('previousURL')}}" class="btn dropbtn btn-primary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
        @endslot
  @endcomponent
@include('layouts.admin.partials.flash-message')
    <section class="section">
        <div class="section-body">
            <div class="recordNavWrapper"></div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link nav-tab active" id="details-tab" data-target="#details" data-bs-toggle="tab" href="#details" role="tab"
                                aria-controls="details" aria-selected="false">Details</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="d-flex flex-wrap my-2 wrap-col-rev-450">
                                <div class="col-10">
                                    <div id="editable">
                                        {{ html()->form('PATCH', 'users.update')->open() }}
                                        @include('users.show_fields')
                                        @php
                                            $audit_class = $user;
                                        @endphp
                                        <div class="float-end fst-italic lighter-link"><a href="{{route('auditLog', array('model' => get_class($user), 'id' => $user->id ))}}" class="text-secondary fw-normal">Audit Log</a></div>
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

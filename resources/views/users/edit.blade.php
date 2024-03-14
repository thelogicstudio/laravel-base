@extends('layouts.admin.master')
@section('title')
    Edit Contact
@endsection
@section('content')
@component('components.breadcrumb')
        @slot('page_options')
            @can('delete', $user)
                <div class="section-header-breadcrumb py-1  dropdown-basic">
                    <a class='btn btn-secondary item-delete' data-bs-toggle="modal" data-id="{{$user->id}}" data-link="/users/destroy/{{$user->id}}" data-bs-target="#deleteModal" title="Delete User" href="#">
                        <i class="fa fa-trash-o"></i> Delete</a>
                </div>
            @endcan
            <div class="section-header-breadcrumb py-1  dropdown-basic">
                <a href="{{ route('users.show',$user->id)}}" class="btn dropbtn btn-primary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
        @endslot
  @endcomponent
  @include('layouts.admin.partials.flash-message')
    <section class="section">
        <div class="content">
{{--            @include('layouts.errors')--}}
            <div class="section-body">
                <div class="recordNavWrapper"></div>
                <div class="card card-warning">
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
                                            {{ html()->form('PATCH', route('users.update', ['user' => $user->id]))->id('user-form')->open() }}
                                                @include('users.fields')
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
    </section>
@endsection

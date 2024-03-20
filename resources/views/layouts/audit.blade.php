@extends('layouts.admin.master')
@section('title')
    Audit Log
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start my-2">
                    <h3>Audit Log</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Audit Log</li>
                    </ol>
                </div>
                <div class="col-md-5 my-2">

                </div>
            </div>
        @endslot
    @endcomponent
    <section class="section">
        <div class="section-body">
            <div class="container-fluid dashboard-default-sec">
                <div class="row">
                    <div class="col-12 table-responsive-xxl">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" >
                                    <thead class="thead-dark">
                                    <tr>
{{--                                        <th scope="col">Model</th>--}}
                                        <th scope="col">Time</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Old Values</th>
                                        <th scope="col">New Values</th>
                                    </tr>
                                    </thead>
                                    <tbody id="audits">
                                    @if(count($audits) > 0)
                                        @foreach($audits as $audit)
                                            <tr>
                                                <td>{{ $audit->created_at }}</td>
{{--                                                <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>--}}
                                                <td>{{ $audit->event }}</td>
                                                <td>{{ $audit->user->name }}</td>
                                                <td>
                                                    <table class="table">
                                                        @foreach($audit->old_values as $attribute => $value)
                                                            <tr>
                                                                <td width="50%"><b>{{ $attribute }}</b></td>
                                                                <td>{{ $value }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="table">
                                                        @foreach($audit->new_values as $attribute => $value)
                                                            <tr>
                                                                <td width="50%"><b>{{ $attribute }}</b></td>
                                                                <td>{{ $value }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No Logs.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

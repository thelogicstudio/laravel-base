@php

$grouped_privileges = \App\Models\Privilege::orderBy('model', 'asc')
    ->get()
    ->groupBy('model');

$role_privileges = [];

if (isset($role)) {
    $role_privileges = $role
        ->privileges()
        ->get()
        ->pluck('id')
        ->toArray();
}
@endphp

<!-- Name Field -->
<div class="form-group mb-4 mt-4">
    <span class="mr-4"><span class="fw-bold small-caps">role name</span>: {{ $role->name }}
</div>

<div class="form-group col-sm-12">
    <h4 class="inner-h4">
        <i class="fa fa-lock text-danger"> </i> Privileges
    </h4>
    @foreach ($grouped_privileges as $key => $privileges)
        <h5 class="inner-h5 pb-2">
            <i class="text-danger"> </i>{{ ucfirst($key) }}
        </h5>
        @foreach ($privileges as $privilege)
            <div class="form-check form-check-inline">
                <div class="checkbox p-0">
                    @if (isset($role))
                        @can('update', $role)
                            @if (in_array($privilege->id, $role_privileges))
                                @php $checked = true; @endphp
                            @else
                                @php $checked = false; @endphp
                            @endif
                                {!! html()->checkbox('privileges[]')->class('form-check-input')->id($privilege->name)->disabled()->checked($checked) !!}
                        @endcan
                    @else
                        @can('create', \App\Models\Role::class)
                            {!! html()->checkbox('privileges[]')->class('form-check-input')->id($privilege->name)->disabled()->checked($checked) !!}
                        @endcan
                    @endif
                    <label class="form-check-label" for="{{ $privilege->name }}">
                        {{ ucfirst(str_replace('_', ' ', $privilege->name)) }}
                    </label>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12 py-2 editOptions mt-5">
    <a href="{{ route('roles.index') }}" class="btn dropbtn btn-secondary btn-round">Back</a>
</div>

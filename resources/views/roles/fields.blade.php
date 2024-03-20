<!-- Name Field -->
<div class="form-group col-md-8 col-xl-3 col-lg-8 col-8">
    {{ html()->label('Name') }}
    {{ html()->text('name')->class('form-control')->required()->value($role->name) }}
</div>

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

<div class="form-group col-sm-12">
{{--    <h4 class="inner-h4">--}}
{{--        <i class="fa fa-unlock-alt text-danger"> </i> Privileges--}}
{{--    </h4>--}}
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
                            {{ html()->checkbox('privileges[]')->class('form-check-input')->checked($checked)->value($privilege->id)->id($privilege->name) }}
                        @endcan
                    @else
                        @can('create', \App\Models\Role::class)
                            {{ html()->checkbox('privileges[]')->class('form-check-input')->checked(false)->value($privilege->id)->id($privilege->name) }}
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
@can('update', $role)
<div class="form-group col-sm-12 py-2 editOptions">
    {{ html()->submit('Save')->class('btn btn-primary') }}
    <button type="button" class="btn btn-danger cancel-edit" data-id="{{$role->id}}" data-link="/roles/{{$role->id}}" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>

</div>
@endcan

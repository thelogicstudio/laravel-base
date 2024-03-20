<div data-component="sidebar">
    <div class="sidebar">
        <ul class="list-group flex-column d-inline-block first-menu pt-2">
            <li class="list-group-item pl-3">
                <a href="{{route('dashboard')}}" class="{{routeActive('dashboard')}}"><i data-feather="home"></i> <span class="ml-1 first-menu-item align-middle">Dashboard</span></a>
            </li> <!-- /.list-group-item -->

            @can('index', \App\Models\User::class)
            <li class="list-group-item pl-3" aria-expanded="{{(routeActive('roles.index') == 'active' || routeActive('users.index') == 'active') ? 'true' : 'false'}}"> <!-- Area expand true | false for arrow direction-->
                <a href="#" class="{{routeActive('users.index')}} {{routeActive('roles.index')}}"><i data-feather="users"></i> <span class="ml-1 first-menu-item align-middle">Users & Roles</span></a> <span class="submenu-icon ml-auto"></span>
                <ul class="list-group flex-column d-inline-block submenu {{(routeActive('roles.index') == 'active' || routeActive('users.index') == 'active') ? '' : 'd-none'}}"> <!-- d-none will hide sub menu -->
                    <li class="pl-1 py-1 mt-2">
                        <i class="fa fa-circle-thin {{routeActive('users.index') ? 'active' : ''}}" aria-hidden="true"></i>
                        <a href="{{route('users.index')}}" class="second-menu-item {{routeActive('users.index') ? 'active' : ''}}"><span>Users</span></a>
                    </li>
                    @can('create', \App\Models\Role::class)
                        <li class="pl-1 py-1 mt-2">
                            <i class="fa fa-circle-thin {{routeActive('roles.index')}}" aria-hidden="true"></i>
                            <a href="{{route('roles.index')}}" class="{{routeActive('roles.index')}} second-menu-item"><span>Roles</span></a>
                        </li>
                    @endcan
                </ul> <!-- /.submenu -->
            </li> <!-- /.list-group-item -->
            @endcan
            <li class="list-group-item pl-3">
                <a href="/profile" class="{{routeActive('profile.edit')}}"><i data-feather="user"></i> <span class="ml-1 first-menu-item align-middle">My Profile</span></a>
            </li>
        </ul> <!-- /.first-menu -->
    </div> <!-- /.sidebar -->
</div>


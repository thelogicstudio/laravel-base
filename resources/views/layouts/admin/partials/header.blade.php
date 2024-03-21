<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{asset('images/logo.svg')}}" alt="" style="height: 30px;"></a></div>
      <div class="dark-logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{asset('images/logo.svg')}}" alt="" style="height: 30px;"></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="menu" id="sidebar-toggle">    </i></div>
    </div>
    <div class="left-menu-header col">
        <h6 class="title text-uppercase color-orange-800">{{config('constants.options.organisation')}}</h6>
      <ul>
        <li>
          <form class="form-inline search-form global-search-form" id="global-search-form" onsubmit="return false;">
            <div class="search-bg">
              <input type="text" class="form-control search-input global-search-input" placeholder="Search here....." autocomplete="off" id="global-search">
                <a class="btn btn-search global-search">
                    <span id="global-search-span" class="spinner-border-sm" role="status" aria-hidden="true"> <i class="fa fa-search search-icon"></i></span> </a>
            </div>
          </form>
{{--          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>--}}
        </li>
      </ul>
    </div>
    <div id="suggestion-box"></div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
          <div class="resizer mr-3">
              <button class="sm fs-7 btn btn-default">A-</button>
              <button class="md fs-6 btn btn-default">A</button>
              <button class="lg fs-5 btn btn-default">A+</button>
          </div>
          {{--Edit toggle--}}
          <li class="nav-item">
              <div class="nav-link" id="edit-mode-toggle">

                  <input type="checkbox" id="edit-mode-input">
                  <label for="edit-mode-input" class="edit-mode-toggle-label">
                      <span class="edit-mode-label" id="setViewMode"><i class="fa fa-eye"></i></span>
                      <span class="edit-mode-label" id="setEditMode"><i class="fa fa-pencil"></i></span>
                  </label>

              </div>
              {{-- <p class="edit-mode-text">Edit Mode</p>--}}
          </li>
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>


          {{-- LIGHT/DARK MODE--}}
        <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>

        <li class="onhover-dropdown p-0">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
          </form>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
@php
    Session::forget('field','order_by','sort'); //this will remove the session for artwork sorting option
@endphp

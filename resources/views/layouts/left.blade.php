<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <!--- Divider -->
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title">Menu Utama</li>
        <li class="{{ Request::is('home') ? 'active' : '' }}">
          <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
        </li>

        @if(Auth::user()->level_user == 1)
          @foreach(\App\Menu::all() as $admin)
          <li class="has-sub">
            <a href="#" class="waves-effect"><i class="{{$admin->icon}}"></i> <span>{{$admin->nama_menu}}</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
              @foreach(\App\Submenu::where('menu_id',$admin->id)->where('role_id', Auth::user()->level_user)->get() as $sub)
              <li>
                <a href="{{url($sub->link)}}">{{$sub->nama_submenu}}</a>
              </li>
              @endforeach
            </ul>
          </li>
          @endforeach
        @else
          @foreach(\App\Menu::where('tipe','user')->get() as $admin)
          <li class="has-sub">
            <a href="#" class="waves-effect"><i class="{{$admin->icon}}"></i> <span>{{$admin->nama_menu}}</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
              @foreach(\App\Submenu::where('menu_id',$admin->id)->where('role_id', Auth::user()->level_user)->get() as $sub)
              <li>
                <a href="{{url($sub->link)}}">{{$sub->nama_submenu}}</a>
              </li>
              @endforeach
            </ul>
          </li>
          @endforeach
        @endif
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
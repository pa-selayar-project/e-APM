<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <!--- Divider -->
    <div id="sidebar-menu">
      <ul>

        <li class="text-muted menu-title">Menu Utama</li>

        <li class="{{ Request::is('home') ? 'active' : '' }}">
          <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>

        </li>
        <?php
        $menu_user  = \App\Menu::where('tipe', 'user')->get();
        $menu_admin = \App\Menu::where('tipe', 'admin')->get();
        $user = Auth::user()->jenis_user;
        ?>

        @if($user == "ADMIN")
        <li class="has-sub">
          <a href="#" class="waves-effect"><i class="fa fa-frown-o"></i> <span>APM</span> <span class="menu-arrow"></span> </a>
          <?php
          $submenu = \App\Submenu::where('menu_id', 1)->get();
          ?>
          <ul class="list-unstyled">
            @foreach($submenu as $sub)
            <li><a href="{{$sub->link}}">{{$sub->nama_submenu}}</a></li>
            @endforeach
          </ul>
        </li>
        @else
        @foreach($menu_user as $m)
        <li class="has_sub">
          <a href="{{$m->link}}" class="waves-effect"><i class="{{$m->icon}}"></i> <span>{{$m->nama_menu}}</span> <span class="menu-arrow"></span> </a>
          <?php
          $submenu = \App\Submenu::where('menu_id', '=', $m->id)->get();
          ?>
          <ul class="list-unstyled">
            @foreach($submenu as $sub)
            <li><a href="{{url($sub->link)}}">{{$sub->nama_submenu}}</a></li>
            @endforeach
          </ul>
        </li>
        @endforeach
        @endif


        @if(Auth::user()->level_user == 1)
        <li class="text-muted menu-title">Menu Admin</li>
        @foreach($menu_admin as $m)
        <li class="has_sub">
          <a href="{{$m->link}}" class="waves-effect"><i class="{{$m->icon}}"></i> <span>{{$m->nama_menu}}</span> <span class="menu-arrow"></span> </a>
          <?php
          $submenu = \App\Submenu::where('menu_id', '=', $m->id)->get();
          ?>
          <ul class="list-unstyled">
            @foreach($submenu as $sub)
            <li><a href="{{$sub->link}}">{{$sub->nama_submenu}}</a></li>
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
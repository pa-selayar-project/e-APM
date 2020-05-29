<div class="topbar">

  <!-- LOGO -->
  <div class="topbar-left">
    <div class="text-center">

      <a href="{{url('dashboard')}}" class="logo">
        <img src="{{url('assets/images/favicon.png')}}" height="40" width="35"></i>
        <span><img src="{{url('assets/images/logo_light.png')}}" height="20" /></span>
      </a>
    </div>
  </div>

  <!-- Button mobile view to collapse sidebar menu -->
  <div class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="">
        <div class="pull-left">
          <button class="button-menu-mobile open-left waves-effect waves-light">
            <i class="md md-menu"></i>
          </button>
          <span class="clearfix"></span>
        </div>

        <ul class="nav navbar-nav hidden-sm hidden-xs">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Link Cepat <span class="caret"></span></a>
            <!-- <ul class="dropdown-menu">
              <li><a href="#">Daftar SK</a></li>
              <li><a href="#">Daftar SOP</a></li>
              <li><a href="#">Daftar Surat Tugas</a></li>
              <li><a href="#">Daftar Surat Cuti</a></li>
            </ul> -->
          </li>
        </ul>

        <form role="search" class="navbar-left app-search pull-left hidden-xs">
          <input type="text" placeholder="Search..." class="form-control">
          <a href=""><i class="fa fa-search"></i></a>
        </form>


        <ul class="nav navbar-nav navbar-right pull-right">
          <li class="hidden-xs">
            <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
          </li>
          <li class="dropdown top-menu-item-xs">
            <a href="javascript:void(0);" class="dropdown-toggle profile waves-effect waves-light text-white" data-toggle="dropdown" aria-expanded="true">
              @if(Auth::user()->image != '')
              <img src="{{url('assets/images')}}/{{Auth::user()->image}}" alt="user-img" class="img-circle m-l-5 m-r-15">
              @else
              <img src="{{url('assets/images/no_user_avatar.png')}}"  alt="user-img" class="img-circle m-l-5 m-r-15">
              @endif
                {{Auth::user()->name}}
            </a>
            <ul class="dropdown-menu">
              <?php $menus = \App\MenuProfil::all(); ?>
              @foreach($menus as $menu)
              <li><a href="{{$menu->link}}"><i class="{{$menu->icon}} m-r-10 text-custom"></i> {{$menu->nama_menu}}</a></li>
              @endforeach
              <li>
                <form method="POST" action="{{url('logout')}}">
                  @csrf
                  <button class="btn btn-white btn-custom btn-rounded waves-effect m-l-15 m-b-10" type="submit"><i class="ti-power-off m-r-10 text-danger"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
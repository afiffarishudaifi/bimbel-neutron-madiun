<div class="az-headpanel-left">
    <a id="naviconMenu" href="#" class="az-navicon d-none d-lg-flex">
        <i class="livicon-evo inline-block" data-options="
        name: morph-menu-arrow-left.svg;
        size: 23px;
        style: lines;
        strokeColor: #fff;
        drawOnViewport: true"></i></a>
    <a id="naviconMenuMobile" href="#" class="az-navicon d-lg-none"><i class="livicon-evo inline-block" data-options="
        name: morph-menu-arrow-right.svg;
        size: 23px;
        style: lines;
        strokeColor: #fff;
        drawOnViewport: true"></i></a>
</div><!-- az-headpanel-left -->

<div class="az-headpanel-right">
    <div class="dropdown dropdown-profile">
        <a href="{{ url('/' . config('pathadmin.admin_name') . '/home') }}" class="nav-link nav-link-profile"
            data-toggle="dropdown">
            {{-- <img src="" class="wd-32 rounded-circle" alt="logo"> --}}
            <span class="logged-name"><span class="hidden-xs-down">{{ Session::get('nama') }}</span> <i
                    class="fa fa-angle-down mg-l-3"></i></span>
        </a>
        <div class="dropdown-menu wd-200">
            <ul class="list-unstyled user-profile-nav">
                {{-- <li><a href="#"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li> --}}
                {{-- <li><a href="#"><i class="icon ion-ios-gear-outline"></i> Settings</a></li> --}}
                <li>
                    <a href="javascript:void" onclick="$('#logout-form').submit();">
                        <i class="livicon-evo inline-block"
                            data-options="name: morph-login.svg;size: 23px;style: filled;strokeColor: #747474;fillColor: #decfff;drawDelay: 0.5;drawOnViewport: true"></i>&nbsp;keluar
                    </a>
                </li>
            </ul>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

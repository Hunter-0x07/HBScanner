<div class="container">
    <div class="top-navbar header b-b"><a data-original-title="Toggle navigation" class="toggle-side-nav pull-left"
                                          href="#"><i class="icon-reorder"></i> </a>
        <div class="brand pull-left"><a href="{{ route('home') }}"><h2>HBScanner</h2></a></div>
        <ul class="nav navbar-nav navbar-right  hidden-xs">
            <li class="dropdown user  hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i
                        class="icon-male"></i> <span class="username">{{ $user->name }}</span> <i class="icon-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="user_profile.html"><i class="icon-user"></i>个人中心</a></li>
                    <li><a href="login.html"><i class="icon-key"></i>退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

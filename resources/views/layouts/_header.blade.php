<div class="container">
    <div class="top-navbar header b-b"><a data-original-title="Toggle navigation" class="toggle-side-nav pull-left"
                                          href="#"><i class="icon-reorder"></i> </a>
        <div class="brand pull-left"><a href="{{ route('home') }}"><h2>HBScanner</h2></a></div>
        <ul class="nav navbar-nav navbar-right  hidden-xs">
            <li class="dropdown user  hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i
                        class="icon-male"></i> <span class="username">{{ $user->name }}</span> <i
                        class="icon-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('users.edit', $user->id) }}"><i class="icon-user"></i>个人中心</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="icon-key" type="submit" name="button">退出</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

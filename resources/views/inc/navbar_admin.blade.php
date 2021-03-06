<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Carpool</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ __('Manage System') }}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('members.index')}}">{{ __('Manage Users') }}</a></li>
                        <li><a href="{{route('carpools.index')}}">{{ __('Manage Carpools') }}</a></li>
                    </ul>
                </li>
                <li><a href="/admin">Dashboard</a></li>
                <li><a href="{{url('/logout')}}">Sign Out</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>




<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laravel</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">Accueil <span class="sr-only">(current)</span></a></li>
		@if(Route::is('book.*') == false)
		@forelse ($genres as $id  => $genre)
        <li><a href="{{url('genre', $id)}}">{{ucfirst($genre)}}</a></li>
        @empty
        @endforelse
        </li>
    @endif
      </ul>

      <ul class="nav navbar-nav navbar-right">
        {{--Renvoie true si vous êtes connecté --}}
        @if(Auth::check())
        <li><a href="{{route('book.index')}}">Dashboard</a></li>
        <li>
          <a href="{{route('logout')}}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout
          </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
          {{ csrf_field() }}
        </form>
        </li>
        @else
        <li><a href="{{route('login')}}">Login</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

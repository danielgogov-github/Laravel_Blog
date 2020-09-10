<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">
        Laravel Blog
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @auth
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Frontend</a>
                <a href="{{ url('/categories') }}" class="nav-item nav-link {{ Request::is('categories') ? 'active' : '' }}">Categories</a>
                <a href="{{ url('/posts') }}" class="nav-item nav-link {{ Request::is('posts') ? 'active' : '' }}">Posts</a>
                <a href="{{ url('/comments') }}" class="nav-item nav-link {{ Request::is('comments') ? 'active' : '' }}">Comments</a>
                <a href="{{ url('/users') }}" class="nav-item nav-link {{ Request::is('users') ? 'active' : '' }}">Users</a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/logout') }}"
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" --}}
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endauth

        @guest
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                </li>

                @isset($categories)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @forelse ($categories as $key => $category)
                                <a href="{{ url('/show/category/'. $key) }}" class="dropdown-item">{{ $category }}</a>
                            @empty
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            @endforelse                            
                        </div>
                    </li>
                @endisset
            </ul>                
        @endguest
    </div>
</nav>

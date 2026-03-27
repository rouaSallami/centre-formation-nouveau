<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">
            <i class="fa fa-book me-3"></i>eLEARNING
        </h2>
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
   <div class="navbar-nav ms-auto p-4 p-lg-0">

    <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>

    <a href="{{ route('about') }}" class="nav-item nav-link">About</a>

    <a href="{{ route('course') }}" class="nav-item nav-link">Courses</a>

    @auth
        @if(auth()->user()->role->nom === 'administrateur')
            <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link">
                Dashboard
            </a>
        @elseif(auth()->user()->role->nom === 'formateur')
            <a href="{{ route('formateur.dashboard') }}" class="nav-item nav-link">
                Dashboard
            </a>
        @endif
    @endauth

    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>

</div>

    <!-- 👇 الجزء الجديد -->
    <div class="d-flex align-items-center me-4">

        @auth
            <span class="me-3">
                👋 {{ auth()->user()->nom }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-primary">
                Register
            </a>
        @endguest

    </div>
</div>
</nav>
<!-- Navbar End -->
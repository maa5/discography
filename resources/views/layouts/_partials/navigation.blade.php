<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo myDiscography" width="250">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('artists.*') ? 'active' : '' }}"
                        href="{{ route('artists.index') }}">Artists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lps.*') ? 'active' : '' }}"
                        href="{{ route('lps.index') }}">LPs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}"
                        href="{{ route('report.index') }}">Report</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

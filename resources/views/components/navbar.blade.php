<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-dark text-decoration-underline" href="{{ route('subscribers.create')  }}"> Subscribe</a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbar"
                    aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse float-end" id="navbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('integration.show') }}">Api Integration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/subscribers">Subscribers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

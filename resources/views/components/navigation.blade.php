<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('dashboard.dashboard') }}">
                <img src="{{asset('images/Ansible_Logo.png')}}" width="110" height="32" alt="Tabler"
                     class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                   aria-label="Show notifications">
                    <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path
                            d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                    </svg>
                    <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur
                            exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet
                            debitis et magni maxime necessitatibus ullam.
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                          style="background-image: url(https://avatars.githubusercontent.com/u/46260610?v=4)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>B14ckP4nd4</div>
                        <div class="mt-1 small text-muted">FullStack Dev / DevOp</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Set status</a>
                    <a href="#" class="dropdown-item">Profile & account</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.dashboard') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline
                              points="5 12 3 12 12 3 21 12 19 12"/><path
                              d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path
                              d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                    </span>
                            <span class="nav-link-title">
                      Home
                    </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.inventory') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-forklift" width="44"
                           height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <circle cx="5" cy="17" r="2"/>
                          <circle cx="14" cy="17" r="2"/>
                          <line x1="7" y1="17" x2="12" y2="17"/>
                          <path d="M3 17v-6h13v6"/>
                          <path d="M5 11v-4h4"/>
                          <path d="M9 11v-6h4l3 6"/>
                          <path d="M22 15h-3v-10"/>
                          <line x1="16" y1="13" x2="19" y2="13"/>
                      </svg>
                    </span>
                            <span class="nav-link-title">
                      Inventories
                    </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.inventory-items') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="44"
                           height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"/>
                      <line x1="12" y1="12" x2="20" y2="7.5"/>
                      <line x1="12" y1="12" x2="12" y2="21"/>
                      <line x1="12" y1="12" x2="4" y2="7.5"/>
                      <line x1="16" y1="5.25" x2="8" y2="9.75"/>
                    </svg>
                    </span>
                            <span class="nav-link-title">
                      Inventory Items
                    </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.inventory-vars') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sitemap" width="44"
                           height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <rect x="3" y="15" width="6" height="6" rx="2"/>
                      <rect x="15" y="15" width="6" height="6" rx="2"/>
                      <rect x="9" y="3" width="6" height="6" rx="2"/>
                      <path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1"/>
                      <line x1="12" y1="9" x2="12" y2="12"/>
                    </svg>
                    </span>
                            <span class="nav-link-title">
                              Inventory Variables
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.playbooks') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                          <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                          <line x1="3" y1="6" x2="3" y2="19" />
                          <line x1="12" y1="6" x2="12" y2="19" />
                          <line x1="21" y1="6" x2="21" y2="19" />
                        </svg>
                    </span>
                            <span class="nav-link-title">
                                PlayBooks
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.plays') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-play" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M7 4v16l13 -8z" />
                      </svg>
                    </span>
                            <span class="nav-link-title">
                                Plays
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

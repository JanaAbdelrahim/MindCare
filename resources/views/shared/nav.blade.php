<nav id="mainNav" class="navbar navbar-expand-lg">
    <div class="container">
        @if (session('admin_logged_in') || auth('patient')->check() || auth('therapist')->check())
            <a class="navbar-brand" href="{{ route('home') }}">mind<span>Care</span></a>
        @else
            <a class="navbar-brand" href="#home">mind<span>Care</span></a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-lg-center">
                @if (session('admin_logged_in'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">User Management</a>
                    </li>
                    <div class="d-flex">
                        <li class="nav-item">
                            <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ session('admin_name') }}
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        </a>
                                    </li>
                                </form>
                            </ul>
                        </li>
                    </div>
                @elseif (auth('patient')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.wellness') }}">Wellness</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.matching') }}">Matched Therapists</a>
                    </li>
                    <li class="nav-item">
                        @php
                            $nextNav = auth('patient')
                                ->user()
                                ->sessions()
                                ->whereIn('status', ['scheduled', 'pending'])
                                ->where('session_time', '>=', now())
                                ->orderBy('session_time')
                                ->first();
                        @endphp
                        @if ($nextNav)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.waitingRoom', $nextNav->id) }}">Waiting Room</a>
                    </li>
                @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.complaints') }}">Send Complaint</a>
                </li>
                <div class="d-flex">
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth('patient')->user()->first_name }}
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('patient.profile') }}">Profile</a>
                            </li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </a>
                                </li>
                            </form>
                        </ul>
                    </li>
                </div>

                {{-- ==================== THERAPIST ==================== --}}
            @elseif (auth('therapist')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('therapist.patients') }}">Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('therapist.slots') }}">Availability Slots</a>
                </li>
                <div class="d-flex">
                    <li class="nav-item">
                        <div class="nav-link btn-nav-cta" onclick="openPopUp('notifications')">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link btn-nav-cta dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth('therapist')->user()->first_name }}
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('therapist.profile') }}">Profile</a>
                            </li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </a>
                                </li>
                            </form>
                        </ul>
                    </li>
                </div>

                {{-- ==================== GUEST ==================== --}}
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#FAQ">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-nav-cta" href="{{ route('register') }}">Get Started</a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<div class="popUp list notifications" onclick="closePopUp()">
    <div class="box">
        <i class="fa-solid fa-xmark close" onclick="closePopUp()"></i>
        <h2 class="title">Notifications</h2>
    </div>
</div>

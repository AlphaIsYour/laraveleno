{{-- navbar.blade.php --}}
<div class="container position-relative">
    <nav class="navbar navbar-expand-lg navbar-dark galaxy-nav mt-3 rounded-2 px-4" style="z-index: 5;">
        <div class="container-fluid">
            <button class="navbar-toggler neon-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand fw-bold fs-4 neon-text" href="{{ url('/') }}">
                <span class="brand-text">LARAVELENO</span>
            </a>
            
            <button class="btn minimize-btn ms-2 d-none d-lg-block" id="minimizeNav" aria-label="Minimize Navigation">
                <i class="fas fa-compress" aria-hidden="true"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @php
                        $navItems = [
                            ['title' => 'Home', 'route' => '/', 'active' => $title === ''],
                            ['title' => 'About', 'route' => '/about', 'active' => $title === ''],
                            ['title' => 'Post', 'route' => '/posts', 'active' => $title === 'Posts'],
                            ['title' => 'Categories', 'route' => '/categories', 'active' => $title === 'Categories'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <li class="nav-item mx-2">
                            <a class="nav-link {{ $item['active'] ? 'active ' : '' }}" 
                               href="{{ url($item['route']) }}"
                               @if($item['active']) aria-current="page" @endif>
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <ul class="navbar-nav ms-auto" >
                    @auth
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle user-dropdown" 
                               id="navbarDropdown" 
                               role="button" 
                               data-bs-toggle="dropdown" 
                               aria-expanded="false">
                                Welcome, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu galaxy-dropdown"  aria-labelledby="navbarDropdown">
                                <li>
                                    <a href="{{ url('/dashboard') }}" class="dropdown-item">
                                        <i data-feather="codesandbox" class="feather-icon"></i> 
                                        <span>My Dashboard</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ url('/logout') }}" method="post" id="logoutForm">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i data-feather="log-out" class="feather-icon"></i> 
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ url('/login') }}" class="nav-link d-flex align-items-center gap-2 login-btn">
                                <span class="fw-semibold">Login 
                                    <i data-feather="log-in" class="feather-icon"></i>
                                </span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>

<style>
:root {
    --nav-bg-gradient-start: #000428;
    --nav-bg-gradient-end: #004e92;
    --nav-border-color: rgba(255, 255, 255, 0.1);
    --nav-shadow-color: rgba(0, 78, 146, 0.5);
    --nav-link-color: rgba(255, 255, 255, 0.8);
    --nav-link-hover-shadow: rgba(0, 225, 255, 0.944);
    --dropdown-bg: rgba(0, 0, 0, 0.9);
}

.galaxy-nav {
    background: linear-gradient(45deg, var(--nav-bg-gradient-start), var(--nav-bg-gradient-end));
    border: 2px solid var(--nav-border-color);
    box-shadow: 0 0 15px var(--nav-shadow-color);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.galaxy-nav.minimized {
    padding: 0.2rem !important;
    transform: scale(0.98);
}

.galaxy-nav .navbar-brand {
    color: #fff;
    position: relative;
}

.brand-text {
    text-shadow: 0 0 10px #00d9ff,
                 0 0 20px #0091ff,
                 0 0 30px #2200ff;
    transition: all 0.3s ease;
}

.galaxy-nav .nav-link {
    color: var(--nav-link-color);
    position: relative;
    transition: all 0.4s ease;
    padding: 0.5rem 1rem;
}

.galaxy-nav .nav-link::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #f4f48e, #0004ff);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.galaxy-nav .nav-link:hover {
    color: #fff;
    text-shadow: 0 0 5px var(--nav-link-hover-shadow);
}

.galaxy-nav .nav-link:hover::before {
    width: 100%;
}

.galaxy-nav .nav-link.active {
    color: #fff;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
}

.galaxy-nav .nav-link.active::before {
    width: 100%;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
}

.minimize-btn {
    background: transparent;
    border: none;
    color: #fff;
    padding: 5px;
    transition: all 0.3s ease;
    opacity: 0.8;
}

.minimize-btn:hover {
    text-shadow: 0 0 10px #00ffff;
    transform: scale(1.1);
    opacity: 1;
}

.minimize-btn:focus {
    outline: none;
    box-shadow: none;
}

.galaxy-dropdown {
    background: var(--dropdown-bg);
    border: 1px solid rgba(0, 255, 255, 0.1);
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
    animation: dropdownFade 0.3s ease;
}

.galaxy-dropdown .dropdown-item {
    color: var(--nav-link-color);
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.galaxy-dropdown .dropdown-item:hover {
    background: rgba(0, 255, 255, 0.1);
    color: #fff;
    text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
}

.login-btn {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    padding: 0.5rem 1.5rem;
}

.login-btn::before {
    content: '';
    position: absolute;
    top: -100%;
    left: -100%;
    width: 300%;
    height: 300%;
    background: linear-gradient(45deg, transparent, rgba(0, 255, 255, 0.2), transparent);
    transform: rotate(45deg);
    transition: all 0.5s ease;
}

.login-btn:hover::before {
    top: -50%;
    left: -50%;
}

.neon-toggle {
    border: 1px solid rgba(0, 255, 255, 0.3);
    animation: glow 2s infinite;
    padding: 0.25rem 0.75rem;
}

.feather-icon {
    width: 18px;
    height: 18px;
    stroke-width: 2;
    vertical-align: -0.125em;
}

@keyframes glow {
    0% { box-shadow: 0 0 5px #ff0000; }
    50% { box-shadow: 0 0 20px #ff00d4, 0 0 30px #0400ff; }
    100% { box-shadow: 0 0 5px #00f7ff; }
}

@keyframes dropdownFade {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .galaxy-nav {
        backdrop-filter: blur(5px);
    }
    
    .navbar-collapse {
        background: rgba(0, 0, 0, 0.95);
        margin: 1rem -1rem -1rem;
        padding: 1rem;
        border-radius: 0.5rem;
    }
    
    .nav-link::before {
        display: none;
    }
}

/* Touch Device Optimizations */
@media (hover: none) {
    .galaxy-nav .nav-link:hover::before {
        width: 0;
    }
    
    .login-btn::before {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Navbar minimize functionality
    const nav = document.querySelector('.galaxy-nav');
    const minimizeBtn = document.getElementById('minimizeNav');
    
    if (minimizeBtn) {
        const icon = minimizeBtn.querySelector('i');
        
        minimizeBtn.addEventListener('click', function() {
            nav.classList.toggle('minimized');
            
            if (nav.classList.contains('minimized')) {
                icon.classList.remove('fa-compress');
                icon.classList.add('fa-expand');
                minimizeBtn.setAttribute('aria-label', 'Expand Navigation');
            } else {
                icon.classList.remove('fa-expand');
                icon.classList.add('fa-compress');
                minimizeBtn.setAttribute('aria-label', 'Minimize Navigation');
            }
        });
    }

    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Dropdown close on click outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.navbar .dropdown-menu.show');
        dropdowns.forEach(dropdown => {
            const dropdownToggle = dropdown.previousElementSibling;
            if (!dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
                dropdown.classList.remove('show');
                dropdownToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // Add smooth scrolling for navbar links
    document.querySelectorAll('.navbar a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (href !== '#') {
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Optional: Save navbar state in localStorage
    const savedState = localStorage.getItem('navbarState');
    if (savedState === 'minimized') {
        nav.classList.add('minimized');
        if (minimizeBtn) {
            const icon = minimizeBtn.querySelector('i');
            icon.classList.remove('fa-compress');
            icon.classList.add('fa-expand');
        }
    }

    minimizeBtn?.addEventListener('click', function() {
        localStorage.setItem('navbarState', 
            nav.classList.contains('minimized') ? 'minimized' : 'normal'
        );
    });
});
</script>
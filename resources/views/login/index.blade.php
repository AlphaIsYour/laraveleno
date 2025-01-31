{{-- File: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <!-- Bootstrap 5.0.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 1s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        .earth-container {
            position: absolute;
            right: -20%;
            top: 50%;
            transform: translateY(-50%);
            width: 70vh;
            height: 70vh;
            animation: earthFloat 6s ease-in-out infinite;
        }

        @keyframes earthFloat {
            0%, 100% { transform: translateY(-50%) translateX(0); }
            50% { transform: translateY(-50%) translateX(-20px); }
        }

        .earth {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, 
                #4b9cd3 0%, 
                #277db7 30%, 
                #156cad 60%, 
                #02416d 90%);
            position: relative;
            box-shadow: 
                -20px -20px 50px 2px rgba(0, 0, 0, 0.5) inset,
                0 0 20px 2px rgba(255, 255, 255, 0.2);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .earth::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path fill="%2334a853" d="M20,20 Q40,40 20,60 T40,80 T60,60 T80,40 T60,20 T40,40 T20,20" opacity="0.3"/></svg>');
            background-size: 40% 40%;
            animation: continentsRotate 30s linear infinite;
        }

        @keyframes continentsRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .ufo {
            position: absolute;
            width: 60px;
            height: 30px;
            left: -60px;
            animation: ufoFly 15s linear infinite;
        }

        @keyframes ufoFly {
            0% {
                left: -60px;
                top: 70%;
                transform: rotate(0deg);
            }
            25% {
                left: 30%;
                top: 40%;
                transform: rotate(-10deg);
            }
            75% {
                left: 60%;
                top: 60%;
                transform: rotate(10deg);
            }
            100% {
                left: 120%;
                top: 30%;
                transform: rotate(0deg);
            }
        }

        .ufo-body {
            width: 100%;
            height: 15px;
            background: linear-gradient(90deg, #444, #888, #444);
            border-radius: 20px;
            position: relative;
        }

        .ufo-cockpit {
            width: 30px;
            height: 15px;
            background: linear-gradient(#7cf, #39f);
            border-radius: 15px 15px 0 0;
            position: absolute;
            top: -15px;
            left: 15px;
        }

        .beam {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: radial-gradient(circle at center,
                rgba(255, 255, 255, 0.8) 0%,
                rgba(255, 255, 255, 0) 70%
            );
        }

        .login-container {
            position: relative;
            width: 400px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            z-index: 1;
            animation: fadeInScale 0.8s ease-out;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .login-container h2 {
            color: #fff;
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-floating {
            margin-bottom: 1.5rem;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-floating:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-floating > .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            height: 60px;
        }

        .form-floating > .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .form-floating > label {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem 0.75rem;
        }

        .form-floating > .form-control:focus + label {
            color: #4facfe;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease-out 0.4s backwards;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(79, 172, 254, 0.4);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .register-link {
            margin-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            animation: fadeIn 0.8s ease-out 0.6s backwards;
        }

        .register-link a {
            color: #4facfe;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            text-shadow: 0 0 10px #4facfe;
            color: #fff;
        }

        .alert-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 80%;
            max-width: 600px;
        }

        .invalid-feedback {
            display: block;
            color: #ff4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            animation: fadeIn 0.3s ease-out;
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }

            .earth-container {
                width: 50vh;
                height: 50vh;
            }

            .login-container h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="stars"></div>

    <div class="earth-container">
        <div class="earth"></div>
    </div>

    <div class="ufo">
        <div class="ufo-cockpit"></div>
        <div class="ufo-body"></div>
        <div class="beam"></div>
    </div>

    @if (session()->has('success'))
    <div class="alert-container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert-container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="main-content">
        <div class="login-container">
            <h2>Welcome Back</h2>
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="form-floating">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           placeholder="name@example.com" 
                           value="{{ old('email') }}"
                           required 
                           autocomplete="email"
                           autofocus>
                    <label for="email">Your Email Address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Password" 
                           required 
                           autocomplete="current-password">
                    <label for="password">Your Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                
                <button type="submit" class="btn btn-login">Sign In</button>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="/register">Register now</a>
            </div>

            @if (Route::has('password.request'))
                <div class="register-link mt-2">
                    <a href="/changepass">Forgot Your Password?</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap 5.0.2 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Create stars with improved performance
        const starsContainer = document.querySelector('.stars');
        const createStars = () => {
            const fragment = document.createDocumentFragment();
            for(let i = 0; i < 200; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.width = Math.random() * 3 + 'px';
                star.style.height = star.style.width;
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 2 + 's';
                fragment.appendChild(star);
            }
            starsContainer.appendChild(fragment);
        };
        createStars();

        // Manage UFOs with improved memory management
        const MAX_UFOS = 3;
        const activeUFOs = new Set();

        function createUfo() {
            if (activeUFOs.size >= MAX_UFOS) return;

            const ufoTemplate = document.querySelector('.ufo');
            const newUfo = ufoTemplate.cloneNode(true);
            document.body.appendChild(newUfo);
            activeUFOs.add(newUfo);
            
            setTimeout(() => {
                if (newUfo && newUfo.parentNode) {
                    newUfo.remove();
                    activeUFOs.delete(newUfo);
                }
            }, 15000);
        }

        // Create new UFO every 10 seconds
        const ufoInterval = setInterval(createUfo, 10000);

        // Cleanup function for UFO interval
        window.addEventListener('beforeunload', () => {
            clearInterval(ufoInterval);
        });

        // Auto-dismiss alerts after 5 seconds with improved handling
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    const dismissButton = alert.querySelector('.btn-close');
                    if (dismissButton) {
                        dismissButton.click();
                    } else {
                        alert.remove();
                    }
                }
            }, 5000);
        });

        // Prevent form resubmission on refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
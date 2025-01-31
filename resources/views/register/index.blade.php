<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    .galaxy {
      position: fixed;
      top: 50%;
      left: 50%;
      width: 200vh;
      height: 200vh;
      background: radial-gradient(circle at center,
        rgba(116, 0, 184, 0.5) 0%,
        rgba(65, 88, 208, 0.3) 20%,
        rgba(35, 39, 89, 0.2) 40%,
        transparent 70%
      );
      transform: translate(-50%, -50%);
      animation: galaxyRotate 100s linear infinite;
    }

    @keyframes galaxyRotate {
      0% { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .stars {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      animation: starsRotate 200s linear infinite;
    }

    @keyframes starsRotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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

    .container {
      position: relative;
      width: 400px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      border: 2px solid rgba(255, 255, 255, 0.2);
      padding: 40px;
      transform-style: preserve-3d;
      perspective: 1000px;
      animation: containerFloat 6s ease-in-out infinite;
      z-index: 1;
    }

    @keyframes containerFloat {
      0%, 100% { transform: translateY(0) rotateX(0deg); }
      50% { transform: translateY(-20px) rotateX(5deg); }
    }

    .meteor {
      position: absolute;
      width: 150px;
      height: 2px;
      background: linear-gradient(90deg, #4facfe, transparent);
      animation: meteor 2s linear infinite;
    }

    @keyframes meteor {
      0% {
        transform: rotate(215deg) translateX(0);
        opacity: 1;
      }
      70% {
        opacity: 1;
      }
      100% {
        transform: rotate(215deg) translateX(-1000px);
        opacity: 0;
      }
    }

    .meteor::before {
      content: '';
      position: absolute;
      width: 4px;
      height: 4px;
      border-radius: 50%;
      background: #4facfe;
      box-shadow: 0 0 10px #4facfe;
    }

    .explosion {
      position: absolute;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: radial-gradient(circle at center,
        rgba(255, 255, 255, 1) 0%,
        rgba(255, 200, 100, 0.8) 20%,
        rgba(255, 100, 50, 0.6) 40%,
        transparent 70%
      );
      animation: explode 1s ease-out forwards;
    }

    @keyframes explode {
      0% {
        transform: scale(0);
        opacity: 1;
      }
      100% {
        transform: scale(20);
        opacity: 0;
      }
    }

    .planet {
      position: absolute;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      animation: planetOrbit 20s linear infinite;
    }

    .planet1 {
      background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
      top: -30px;
      right: -30px;
    }

    .planet2 {
      background: linear-gradient(45deg, #4facfe, #00f2fe);
      bottom: -30px;
      left: -30px;
      animation-delay: -10s;
    }

    @keyframes planetOrbit {
      0% { transform: rotate(0deg) translateX(20px) rotate(0deg); }
      100% { transform: rotate(360deg) translateX(20px) rotate(-360deg); }
    }

    h2 {
      color: #fff;
      text-align: center;
      font-size: 2em;
      margin-bottom: 30px;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Bootstrap Form Customization */
    .form-floating > .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: #fff;
      height: calc(3.5rem + 2px);
      line-height: 1.25;
    }

    .form-floating > .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }

    .form-floating > label {
      color: rgba(255, 255, 255, 0.7);
      padding: 1rem;
    }

    .form-floating > .form-control:focus ~ label {
      color: #fff;
      text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    .invalid-feedback {
      color: #ff6b6b;
      font-size: 0.875em;
      margin-top: 0.25rem;
    }

    .btn-register {
      width: 100%;
      padding: 15px;
      background: linear-gradient(45deg, #4facfe, #00f2fe);
      border: none;
      border-radius: 10px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      position: relative;
      overflow: hidden;
    }

    .btn-register::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      transition: 0.5s;
    }

    .btn-register:hover::before {
      left: 100%;
    }

    .alert {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      min-width: 300px;
      text-align: center;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      z-index: 1000;
    }

    .login-link {
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
      margin-top: 20px;
    }

    .login-link a {
      color: #4facfe;
      text-decoration: none;
      transition: 0.3s;
    }

    .login-link a:hover {
      text-shadow: 0 0 10px #4facfe;
    }
  </style>
</head>
<body>
  <div class="galaxy"></div>
  <div class="stars"></div>
  
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container">
    <div class="planet planet1"></div>
    <div class="planet planet2"></div>
    
    <h2>Galactic Register</h2>
    
    <form action="/register" method="post">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your Name" required value="{{ old('name') }}">
        <label for="name">Name</label>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-floating mb-3">
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{ old('username') }}">
        <label for="username">Username</label>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-floating mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required value="{{ old('email') }}">
        <label for="email">Email</label>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-floating mb-4">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <button type="submit" class="btn btn-register">Register</button>
    </form>
    
    <div class="login-link">
      Already have an account? <a href="/login">Login!</a>
    </div>
  </div>

  <!-- Bootstrap 5 Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Create stars
    const starsContainer = document.querySelector('.stars');
    for(let i = 0; i < 200; i++) {
      const star = document.createElement('div');
      star.className = 'star';
      star.style.width = Math.random() * 3 + 'px';
      star.style.height = star.style.width;
      star.style.left = Math.random() * 100 + '%';
      star.style.top = Math.random() * 100 + '%';
      star.style.animationDelay = Math.random() * 2 + 's';
      starsContainer.appendChild(star);
    }

    // Function to create explosion effect
    function createExplosion(x, y) {
      const explosion = document.createElement('div');
      explosion.className = 'explosion';
      explosion.style.left = x + 'px';
      explosion.style.top = y + 'px';
      document.body.appendChild(explosion);
      
      setTimeout(() => {
        explosion.remove();
      }, 1000);
    }

    // Create meteors periodically with more frequency and random sizes
    function createMeteor() {
      const meteor = document.createElement('div');
      meteor.className = 'meteor';
      meteor.style.top = Math.random() * window.innerHeight + 'px';
      meteor.style.left = Math.random() * window.innerWidth + 'px';
      meteor.style.width = (100 + Math.random() * 150) + 'px';
      document.body.appendChild(meteor);
      
      setTimeout(() => {
        const rect = meteor.getBoundingClientRect();
        createExplosion(rect.left, rect.top);
        meteor.remove();
      }, 1900);
    }

    setInterval(createMeteor, 1000);
    
    for(let i = 0; i < 5; i++) {
      setTimeout(createMeteor, i * 200);
    }
  </script>
</body>
</html>
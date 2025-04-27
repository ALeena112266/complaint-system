<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMSComplain</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navigation Bar with Blue Background -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">IMSComplain</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            @if (Route::has('login'))
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Log in</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                  </li>
                @endif
              @endauth
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="container mt-5">
    <div class="text-center">
      <h1>Welcome to IMSComplain System </h1>
      <p class="lead">
        IMSComplain is a complaint management system designed to streamline the process of handling complaints and improve student satisfaction.
        You cab  easily file, track, and resolve your issues.
      </p>
    </div>

    <!-- Detailed Guide Block -->
    <div class="mt-5">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">How to File a Complaint</h2>
          <p>1. Click the "Register" button if you are a new student to create your account.</p>
          <p>2. Fill in your personal and academic details, including your student ID, email, and password.</p>
          <p>3. Confirm your email address by clicking on the verification link sent to you.</p>
          <p>4. Once verified, use the "Log in" button to access your student dashboard.</p>
          <p>5. Navigate to the complaint section where you can file your issue by providing detailed information.</p>
          <p>6. Submit your complaint and monitor its status directly from your dashboard.</p>
          <p>7. For further assistance, refer to the FAQ section or contact our support team.</p>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light text-center text-lg-start mt-5">
    <div class="text-center p-3">
      © {{ date('Y') }} IMSComplain. All rights reserved.
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login | GMET - Geo Mapping Engineering & Technologies</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/gmet-logo.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome & Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --gmet-green: #1f5d2b;
            --gmet-dark: #123b1d;
            --gmet-deep: #0c2613;
            --gmet-light: #eef5ea;
            --gmet-soft: #f7faf5;
            --gmet-red: #e53935;
            --gmet-red-hover: #c92f2b;
            --text-dark: #18231a;
            --muted: #637064;
            --card-border: #dfe8dc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: 
                radial-gradient(circle at 82% 20%, rgba(112, 178, 91, 0.22), transparent 36%),
                radial-gradient(circle at 12% 85%, rgba(229, 57, 53, 0.14), transparent 32%),
                linear-gradient(135deg, #0c2613 0%, #15451e 52%, #081d0f 100%);
            padding: 1.5rem;
            overflow-x: hidden;
        }

        /* Ambient Geometric Map Grid Effect */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        body::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(31, 93, 43, 0.35), transparent 70%);
            top: -150px;
            right: -150px;
            pointer-events: none;
            filter: blur(40px);
        }

        .login-wrapper {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Top Brand Accent Bar */
        .card-accent-bar {
            height: 5px;
            background: linear-gradient(90deg, var(--gmet-green) 0%, #4caf50 70%, var(--gmet-red) 100%);
            width: 100%;
        }

        .login-card-body {
            padding: 2.5rem 2.25rem 2.25rem;
        }

        /* Header & Logo */
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo-wrap {
            width: 76px;
            height: 76px;
            margin: 0 auto 1rem;
            background: #fff;
            border-radius: 50%;
            padding: 4px;
            box-shadow: 0 8px 24px rgba(18, 59, 29, 0.18);
            border: 2px solid var(--gmet-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .eyebrow-badge {
            display: inline-block;
            color: var(--gmet-green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            border-left: 3.5px solid var(--gmet-red);
            padding-left: 0.6rem;
            margin-bottom: 0.4rem;
        }

        .brand-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--gmet-dark);
            letter-spacing: -0.02em;
            margin-bottom: 0.2rem;
        }

        .brand-title span {
            color: var(--gmet-green);
        }

        .brand-subtitle {
            font-size: 0.78rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* Form Controls */
        .form-label {
            font-size: 0.84rem;
            font-weight: 600;
            color: #2c3a2f;
            margin-bottom: 0.45rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: #7b8e7e;
            font-size: 0.95rem;
            z-index: 5;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control-custom {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--text-dark);
            background-color: var(--gmet-soft);
            border: 1.5px solid #dbe6d7;
            border-radius: 0.65rem;
            transition: all 0.2s ease-in-out;
        }

        .form-control-custom.password-input {
            padding-right: 2.75rem;
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--gmet-green);
            box-shadow: 0 0 0 4px rgba(31, 93, 43, 0.12);
            outline: none;
        }

        .input-group-custom:focus-within .input-icon {
            color: var(--gmet-green);
        }

        .password-toggle-btn {
            position: absolute;
            right: 0.75rem;
            background: transparent;
            border: none;
            color: #7b8e7e;
            padding: 0.4rem;
            cursor: pointer;
            z-index: 5;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .password-toggle-btn:hover {
            color: var(--gmet-dark);
        }

        /* Buttons */
        .btn-gmet-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--gmet-green) 0%, var(--gmet-dark) 100%);
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 0.85rem 1.5rem;
            border: none;
            border-radius: 0.65rem;
            box-shadow: 0 6px 18px rgba(18, 59, 29, 0.28);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s ease;
            margin-top: 1.5rem;
        }

        .btn-gmet-submit:hover {
            background: linear-gradient(135deg, #277737 0%, #174b22 100%);
            box-shadow: 0 8px 22px rgba(18, 59, 29, 0.38);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-gmet-submit:active {
            transform: translateY(0);
        }

        /* Footer link */
        .card-footer-links {
            text-align: center;
            margin-top: 1.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid #eef2ec;
        }

        .back-home-link {
            color: var(--muted);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .back-home-link:hover {
            color: var(--gmet-green);
            transform: translateX(-3px);
        }

        /* Alerts */
        .custom-alert {
            border-radius: 0.65rem;
            font-size: 0.86rem;
            font-weight: 500;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .custom-alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--gmet-red);
        }

        .custom-alert-success {
            background-color: #e8f5e9;
            color: #1b5e20;
            border-left: 4px solid var(--gmet-green);
        }

        /* Copyright bottom */
        .page-copyright {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
            margin-top: 1.5rem;
            font-weight: 400;
        }

        @media (max-width: 576px) {
            .login-card-body {
                padding: 2rem 1.5rem 1.75rem;
            }
            .brand-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="card-accent-bar"></div>
        <div class="login-card-body">
            
            <div class="brand-header">
                <div class="brand-logo-wrap">
                    <img src="{{ asset('assets/images/gmet-logo.png') }}" alt="GMET Logo">
                </div>
                <span class="eyebrow-badge">SECURE ACCESS</span>
                <h1 class="brand-title">GME <span>TECHNOLOGIES</span></h1>
                <p class="brand-subtitle">Geo Mapping Engineering & Technologies</p>
            </div>

            @if (session()->has('error'))
                <div class="custom-alert custom-alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-6"></i>
                    <div>{{ session()->get('error') }}</div>
                    <button type="button" class="btn-close ms-auto p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="custom-alert custom-alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check fs-6"></i>
                    <div>{{ session()->get('success') }}</div>
                    <button type="button" class="btn-close ms-auto p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/login') }}" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fa-regular fa-envelope text-muted"></i> Email Address
                    </label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-at input-icon"></i>
                        <input 
                            type="email" 
                            class="form-control-custom" 
                            id="email" 
                            name="email" 
                            placeholder="admin@gmetechnologies.com" 
                            value="{{ old('email') }}"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fa-solid fa-lock text-muted"></i> Password
                    </label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-key input-icon"></i>
                        <input 
                            type="password" 
                            class="form-control-custom password-input" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••••••" 
                            required
                        >
                        <button type="button" class="password-toggle-btn" id="togglePasswordBtn" title="Toggle password visibility" type="button">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-gmet-submit">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In to Portal
                </button>
            </form>

            <div class="card-footer-links">
                <a href="{{ url('/') }}" class="back-home-link">
                    <i class="fa-solid fa-arrow-left"></i> Return to GMET Website
                </a>
            </div>

        </div>
    </div>

    <div class="page-copyright">
        © {{ date('Y') }} GME Technologies. Turning Data, Technology & Ideas into Impact.
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Password toggle visibility script
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>

</body>
</html>

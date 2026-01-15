<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DOLE Household Beneficiary Tracking System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|roboto:400,500,700" rel="stylesheet" />

            <style>
            :root {
                --color-white: #FFFFFF;
                --color-light-gray: #F5F7FA;
                --color-gray: #E5E7EB;
                --color-dark-gray: #6B7280;
                --color-dole-blue: #003366;
                --color-dole-blue-light: #004C99;
                --color-dole-blue-dark: #001F3F;
                --color-dole-gold: #FFB81C;
                --color-dole-gold-light: #FFD54F;
                --color-text: #1F2937;
                --color-text-light: #4B5563;
                --color-border: #D1D5DB;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background-color: var(--color-light-gray);
                color: var(--color-text);
                min-height: 100vh;
                overflow-x: hidden;
            }

            /* Background Pattern */
            .bg-pattern {
                position: fixed;
                inset: 0;
                z-index: 0;
                opacity: 0.05;
                background-image: 
                    linear-gradient(135deg, var(--color-dole-blue) 0%, transparent 50%),
                    linear-gradient(225deg, var(--color-dole-gold) 0%, transparent 50%);
            }

            /* Header */
            header {
                position: relative;
                z-index: 10;
                background: var(--color-dole-blue);
                padding: 1rem 2rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .logo-icon {
                width: 50px;
                height: 50px;
                background: var(--color-white);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 2px solid var(--color-dole-gold);
            }

            .logo-icon svg {
                width: 28px;
                height: 28px;
                color: var(--color-dole-blue);
            }

            .logo-text {
                display: flex;
                flex-direction: column;
            }

            .logo-text .main {
                font-size: 1.125rem;
                font-weight: 700;
                color: var(--color-white);
                letter-spacing: 0.5px;
            }

            .logo-text .sub {
                font-size: 0.75rem;
                font-weight: 400;
                color: var(--color-dole-gold);
                letter-spacing: 0.3px;
            }

            nav {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .nav-link {
                padding: 0.625rem 1.25rem;
                border-radius: 6px;
                font-size: 0.9375rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s ease;
                color: var(--color-white);
            }

            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .nav-link-primary {
                background: var(--color-dole-gold);
                color: var(--color-dole-blue);
            }

            .nav-link-primary:hover {
                background: var(--color-dole-gold-light);
            }

            /* Main Content */
            main {
                position: relative;
                z-index: 10;
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem;
            }

            /* Hero Section */
            .hero {
                display: grid;
                grid-template-columns: 1fr;
                gap: 3rem;
                align-items: center;
                padding: 2rem 0 4rem;
            }

            @media (min-width: 1024px) {
                .hero {
                    grid-template-columns: 1fr 1fr;
                    gap: 4rem;
                    padding: 4rem 0 6rem;
                }
            }

            .hero-content {
                animation: fadeInUp 0.8s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(139, 158, 130, 0.15);
                border: 1px solid rgba(139, 158, 130, 0.3);
                padding: 0.5rem 1rem;
                border-radius: 100px;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-sage-dark);
                margin-bottom: 1.5rem;
            }

            @media (prefers-color-scheme: dark) {
                .hero-badge {
                    color: var(--color-sage);
                }
            }

            .hero-badge svg {
                width: 16px;
                height: 16px;
            }

            .hero-title {
                font-size: clamp(2.5rem, 5vw, 4rem);
                line-height: 1.1;
                margin-bottom: 1.5rem;
                letter-spacing: -0.02em;
            }

            .hero-title-highlight {
                color: var(--color-dole-blue);
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(0, 51, 102, 0.1);
                border: 1px solid rgba(0, 51, 102, 0.2);
                padding: 0.5rem 1rem;
                border-radius: 6px;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-dole-blue);
                margin-bottom: 1.5rem;
            }

            .hero-badge svg {
                width: 16px;
                height: 16px;
            }

            .hero-description {
                font-size: 1.125rem;
                line-height: 1.7;
                color: var(--color-text-light);
                margin-bottom: 2.5rem;
                max-width: 540px;
            }

            .hero-cta {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 1rem 2rem;
                border-radius: 12px;
                font-size: 1rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
                cursor: pointer;
                border: none;
            }

            .btn-primary {
                background: var(--color-dole-blue);
                color: white;
                box-shadow: 0 2px 8px rgba(0, 51, 102, 0.3);
            }

            .btn-primary:hover {
                background: var(--color-dole-blue-light);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(0, 51, 102, 0.4);
            }

            .btn-secondary {
                background: transparent;
                border: 2px solid var(--color-dole-blue);
                color: var(--color-dole-blue);
            }

            .btn-secondary:hover {
                background: var(--color-dole-blue);
                color: white;
            }

            /* Hero Visual */
            .hero-visual {
                position: relative;
                animation: fadeInUp 0.8s ease-out 0.2s both;
            }

            .hero-card {
                background: white;
                border-radius: 8px;
                padding: 2rem;
                box-shadow: 
                    0 1px 3px rgba(0, 0, 0, 0.1),
                    0 4px 12px rgba(0, 0, 0, 0.08);
                border: 1px solid var(--color-border);
            }

            .card-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--color-sand);
            }

            @media (prefers-color-scheme: dark) {
                .card-header {
                    border-color: rgba(232, 222, 212, 0.15);
                }
            }

            .card-header h3 {
                font-size: 1.125rem;
                font-weight: 600;
            }

            .card-header span {
                font-size: 0.875rem;
                color: var(--color-sage-dark);
                font-weight: 500;
            }

            .household-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                border-radius: 12px;
                margin-bottom: 0.75rem;
                background: var(--color-cream);
                transition: all 0.2s ease;
            }

            @media (prefers-color-scheme: dark) {
                .household-item {
                    background: rgba(26, 22, 19, 0.5);
                }
            }

            .household-item:hover {
                transform: translateX(4px);
            }

            .item-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .item-icon svg {
                width: 24px;
                height: 24px;
                color: white;
            }

            .item-icon-blue { background: linear-gradient(135deg, #5B8DEF, #8BB0F4); }
            .item-icon-green { background: linear-gradient(135deg, var(--color-sage), #A8BDA0); }
            .item-icon-orange { background: linear-gradient(135deg, var(--color-terracotta), var(--color-terracotta-light)); }
            .item-icon-purple { background: linear-gradient(135deg, #9B8AC4, #B8A9D9); }

            .item-content {
                flex: 1;
                min-width: 0;
            }

            .item-content h4 {
                font-size: 0.9375rem;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .item-content p {
                font-size: 0.8125rem;
                color: var(--color-warm-gray);
            }

            @media (prefers-color-scheme: dark) {
                .item-content p {
                    color: #8A857E;
                }
            }

            .item-count {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--color-terracotta);
                background: rgba(196, 112, 75, 0.1);
                padding: 0.375rem 0.75rem;
                border-radius: 8px;
            }

            /* Features Section */
            .features {
                padding: 4rem 0;
            }

            .section-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-title {
                font-size: clamp(1.75rem, 3vw, 2.5rem);
                margin-bottom: 1rem;
            }

            .section-description {
                font-size: 1.0625rem;
                color: var(--color-warm-gray);
                max-width: 600px;
                margin: 0 auto;
            }

            @media (prefers-color-scheme: dark) {
                .section-description {
                    color: #9A958E;
                }
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .feature-card {
                background: white;
                border-radius: 20px;
                padding: 2rem;
                border: 1px solid rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
            }

            @media (prefers-color-scheme: dark) {
                .feature-card {
                    background: rgba(45, 42, 38, 0.6);
                    border-color: rgba(255, 255, 255, 0.06);
                }
            }

            .feature-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
            }

            .feature-icon {
                width: 56px;
                height: 56px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.25rem;
            }

            .feature-icon svg {
                width: 28px;
                height: 28px;
                color: white;
            }

            .feature-card h3 {
                font-size: 1.125rem;
                font-weight: 600;
                margin-bottom: 0.625rem;
            }

            .feature-card p {
                font-size: 0.9375rem;
                color: var(--color-warm-gray);
                line-height: 1.6;
            }

            @media (prefers-color-scheme: dark) {
                .feature-card p {
                    color: #8A857E;
                }
            }

            /* Footer */
            footer {
                position: relative;
                z-index: 10;
                text-align: center;
                padding: 2rem;
                font-size: 0.875rem;
                color: var(--color-text-light);
                background: var(--color-white);
                border-top: 1px solid var(--color-border);
            }


            /* Login Card Styles */
            .login-card {
                max-width: 420px;
            }

            .login-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .login-icon {
                width: 64px;
                height: 64px;
                background: var(--color-dole-blue);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.25rem;
                border: 2px solid var(--color-dole-gold);
            }

            .login-icon svg {
                width: 32px;
                height: 32px;
                color: white;
            }

            .login-header h3 {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .login-header p {
                color: var(--color-text-light);
                font-size: 0.9375rem;
            }

            .login-form {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .form-group label {
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-text);
            }

            .input-wrapper {
                position: relative;
                display: flex;
                align-items: center;
            }

            .input-wrapper svg {
                position: absolute;
                left: 1rem;
                width: 20px;
                height: 20px;
                color: var(--color-dark-gray);
                pointer-events: none;
            }

            .input-wrapper input {
                width: 100%;
                padding: 0.875rem 1rem 0.875rem 3rem;
                border: 1px solid var(--color-border);
                border-radius: 6px;
                font-size: 0.9375rem;
                background: var(--color-white);
                color: var(--color-text);
                transition: all 0.2s ease;
            }

            .input-wrapper input::placeholder {
                color: var(--color-dark-gray);
            }

            .input-wrapper input:focus {
                outline: none;
                border-color: var(--color-dole-blue);
                box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
            }

            .form-options {
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 0.875rem;
            }

            .checkbox-wrapper {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
                color: var(--color-text);
            }

            .checkbox-wrapper input[type="checkbox"] {
                width: 18px;
                height: 18px;
                accent-color: var(--color-dole-blue);
                cursor: pointer;
            }

            .forgot-link {
                color: var(--color-dole-blue);
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s ease;
            }

            .forgot-link:hover {
                color: var(--color-dole-blue-light);
                text-decoration: underline;
            }

            .btn-full {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
            }

            .login-footer {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--color-border);
                font-size: 0.9375rem;
                color: var(--color-text-light);
            }

            .login-footer a {
                color: var(--color-dole-blue);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .login-footer a:hover {
                text-decoration: underline;
            }
            </style>
    </head>
    <body>
        <div class="bg-pattern"></div>

        <header>
            <div class="logo">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div class="logo-text">
                    <span class="main">DOLE</span>
                    <span class="sub">Household Beneficiary Tracking</span>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="hero-content">
                    <div class="hero-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        Official Government System
                    </div>
                    
                    <h1 class="hero-title">
                        DOLE <span class="hero-title-highlight">Household Beneficiary</span> Tracking System
                    </h1>
                    
                    <p class="hero-description">
                        Comprehensive tracking and management system for household beneficiaries under the Department of Labor and Employment programs. Monitor, update, and manage beneficiary information efficiently.
                    </p>
                    
                    <div class="hero-cta">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Access System
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="hero-card login-card">
                        <div class="login-header">
                            <div class="login-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <h3>System Access</h3>
                            <p>Sign in to access the beneficiary tracking system</p>
                        </div>
                        
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                    <input type="email" id="email" name="email" placeholder="you@example.com" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                                </div>
                            </div>
                            
                            <div class="form-options">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                    <span>Remember me</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                                @endif
                </div>
                            
                            <button type="submit" class="btn btn-primary btn-full">
                                Sign In
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                            </button>
                        </form>
                        
                        @if (Route::has('register'))
                            <div class="login-footer">
                                <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            </main>

        <footer>
            <p>&copy; {{ date('Y') }} Department of Labor and Employment (DOLE). All rights reserved.</p>
            <p style="margin-top: 0.5rem; font-size: 0.8125rem;">Household Beneficiary Tracking System - Official Government Portal</p>
        </footer>
    </body>
</html>

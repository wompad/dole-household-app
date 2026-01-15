<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard - DOLE Household Beneficiary Tracking System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|roboto:400,500,700" rel="stylesheet" />
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                --color-success: #10B981;
                --color-info: #3B82F6;
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

            .header-actions {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .user-menu {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: var(--color-white);
            }

            .user-avatar {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: var(--color-dole-gold);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: var(--color-dole-blue);
            }

            .btn-logout {
                padding: 0.5rem 1rem;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 6px;
                color: var(--color-white);
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .btn-logout:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            /* Main Content */
            .main-container {
                position: relative;
                z-index: 10;
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem;
            }

            /* Page Header */
            .page-header {
                margin-bottom: 2rem;
            }

            .page-title {
                font-size: 1.875rem;
                font-weight: 700;
                color: var(--color-dole-blue);
                margin-bottom: 0.5rem;
            }

            .page-subtitle {
                font-size: 1rem;
                color: var(--color-text-light);
            }

            /* Alert Messages */
            .alert {
                padding: 1rem 1.25rem;
                border-radius: 6px;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                animation: slideDown 0.3s ease;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .alert-success {
                background: #D1FAE5;
                color: #065F46;
                border: 1px solid #10B981;
            }

            .alert-error {
                background: #FEE2E2;
                color: #991B1B;
                border: 1px solid #EF4444;
            }

            .alert-message {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                flex: 1;
            }

            .alert-close {
                background: none;
                border: none;
                color: inherit;
                font-size: 1.25rem;
                cursor: pointer;
                padding: 0;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0.7;
                transition: opacity 0.2s ease;
            }

            .alert-close:hover {
                opacity: 1;
            }

            /* Statistics Grid */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .stat-card {
                background: var(--color-white);
                border-radius: 8px;
                padding: 1.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                border: 1px solid var(--color-border);
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            .stat-card-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1rem;
            }

            .stat-card-title {
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-text-light);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-card-icon {
                width: 48px;
                height: 48px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .stat-card-icon svg {
                width: 24px;
                height: 24px;
                color: var(--color-white);
            }

            .stat-card-icon.blue {
                background: linear-gradient(135deg, var(--color-dole-blue), var(--color-dole-blue-light));
            }

            .stat-card-icon.gold {
                background: linear-gradient(135deg, var(--color-dole-gold), var(--color-dole-gold-light));
            }

            .stat-card-icon.green {
                background: linear-gradient(135deg, var(--color-success), #34D399);
            }

            .stat-card-icon.info {
                background: linear-gradient(135deg, var(--color-info), #60A5FA);
            }

            .stat-card-value {
                font-size: 2.25rem;
                font-weight: 700;
                color: var(--color-text);
                margin-bottom: 0.5rem;
            }

            .stat-card-change {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.875rem;
                color: var(--color-text-light);
            }

            .stat-card-change.positive {
                color: var(--color-success);
            }

            .stat-card-change svg {
                width: 16px;
                height: 16px;
            }

            /* Dashboard Sections */
            .dashboard-section {
                background: var(--color-white);
                border-radius: 8px;
                padding: 1.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                border: 1px solid var(--color-border);
                margin-bottom: 2rem;
            }

            .section-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--color-border);
            }

            .section-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: var(--color-dole-blue);
            }

            .section-actions {
                display: flex;
                gap: 0.75rem;
            }

            .btn {
                padding: 0.625rem 1.25rem;
                border-radius: 6px;
                font-size: 0.875rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s ease;
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-primary {
                background: var(--color-dole-blue);
                color: var(--color-white);
            }

            .btn-primary:hover {
                background: var(--color-dole-blue-light);
            }

            .btn-secondary {
                background: var(--color-gray);
                color: var(--color-text);
            }

            .btn-secondary:hover {
                background: var(--color-dark-gray);
                color: var(--color-white);
            }

            /* Table Styles */
            .data-table {
                width: 100%;
                border-collapse: collapse;
            }

            .data-table thead {
                background: var(--color-light-gray);
            }

            .data-table th {
                padding: 0.75rem 1rem;
                text-align: left;
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--color-text);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .data-table td {
                padding: 1rem;
                border-top: 1px solid var(--color-border);
                font-size: 0.9375rem;
                color: var(--color-text);
            }

            .data-table tbody tr:hover {
                background: var(--color-light-gray);
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 3rem 1rem;
                color: var(--color-text-light);
            }

            .empty-state svg {
                width: 64px;
                height: 64px;
                margin: 0 auto 1rem;
                color: var(--color-gray);
            }

            /* Pagination */
            .pagination-wrapper {
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--color-border);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .pagination {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .pagination li {
                display: inline-block;
            }

            .pagination a,
            .pagination span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem 0.75rem;
                border-radius: 6px;
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                min-width: 36px;
                transition: all 0.2s ease;
            }

            .pagination a {
                color: var(--color-text);
                background: var(--color-white);
                border: 1px solid var(--color-border);
            }

            .pagination a:hover {
                background: var(--color-dole-blue);
                color: var(--color-white);
                border-color: var(--color-dole-blue);
            }

            .pagination li.active span {
                background: var(--color-dole-blue);
                color: var(--color-white);
                border: 1px solid var(--color-dole-blue);
            }

            .pagination li.disabled span {
                color: var(--color-dark-gray);
                background: var(--color-gray);
                cursor: not-allowed;
                opacity: 0.5;
            }

            .table-actions {
                display: flex;
                gap: 0.5rem;
                align-items: center;
            }

            .table-actions form {
                display: inline-flex;
                align-items: center;
                margin: 0;
            }

            .btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.8125rem;
                min-height: 32px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .btn-danger {
                background: #EF4444;
                color: var(--color-white);
            }

            .btn-danger:hover {
                background: #DC2626;
            }

            .btn-info {
                background: var(--color-info);
                color: var(--color-white);
            }

            .btn-info:hover {
                background: #2563EB;
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
                margin-top: 3rem;
            }

            /* Modal Styles */
            .modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal-container {
                background: var(--color-white);
                border-radius: 8px;
                width: 100%;
                max-width: 900px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                position: relative;
            }

            .modal-header {
                padding: 1.5rem;
                border-bottom: 1px solid var(--color-border);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: var(--color-dole-blue);
                color: var(--color-white);
                border-radius: 8px 8px 0 0;
            }

            .modal-title {
                font-size: 1.25rem;
                font-weight: 600;
                margin: 0;
            }

            .modal-close {
                background: none;
                border: none;
                color: var(--color-white);
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 4px;
                transition: background 0.2s ease;
            }

            .modal-close:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .modal-body {
                padding: 1.5rem;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
                margin-bottom: 1.25rem;
            }

            @media (max-width: 640px) {
                .form-row {
                    grid-template-columns: 1fr;
                }
            }

            .form-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-text);
                margin-bottom: 0.5rem;
            }

            .form-label .required {
                color: #EF4444;
                margin-left: 0.25rem;
            }

            .form-input,
            .form-select {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid var(--color-border);
                border-radius: 6px;
                font-size: 0.9375rem;
                font-family: inherit;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .form-input:focus,
            .form-select:focus {
                outline: none;
                border-color: var(--color-dole-blue);
                box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
            }

            .form-textarea {
                min-height: 100px;
                resize: vertical;
            }

            .form-error {
                color: #EF4444;
                font-size: 0.8125rem;
                margin-top: 0.25rem;
                display: none;
            }

            .form-group.has-error .form-input,
            .form-group.has-error .form-select {
                border-color: #EF4444;
            }

            .form-group.has-error .form-error {
                display: block;
            }

            /* Checkbox/Radio Styles */
            .checkbox-group {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                margin-top: 0.5rem;
            }

            .checkbox-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.75rem;
                border: 1px solid var(--color-border);
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .checkbox-item:hover {
                background: var(--color-light-gray);
                border-color: var(--color-dole-blue);
            }

            .checkbox-item input[type="radio"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: var(--color-dole-blue);
            }

            .checkbox-item input[type="radio"]:checked + label {
                color: var(--color-dole-blue);
                font-weight: 500;
            }

            .checkbox-item:has(input[type="radio"]:checked) {
                background: rgba(0, 51, 102, 0.05);
                border-color: var(--color-dole-blue);
            }

            .checkbox-item label {
                cursor: pointer;
                flex: 1;
                font-size: 0.9375rem;
                color: var(--color-text);
            }

            /* View Modal Details */
            .detail-group {
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid var(--color-border);
            }

            .detail-group:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }

            .detail-label {
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--color-text-light);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }

            .detail-value {
                font-size: 1rem;
                color: var(--color-text);
                font-weight: 500;
            }

            .detail-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .detail-row:last-child {
                margin-bottom: 0;
            }

            @media (max-width: 640px) {
                .detail-row {
                    grid-template-columns: 1fr;
                }
            }

            .modal-footer {
                padding: 1.5rem;
                border-top: 1px solid var(--color-border);
                display: flex;
                justify-content: flex-end;
                gap: 0.75rem;
            }

            .btn-cancel {
                background: var(--color-gray);
                color: var(--color-text);
            }

            .btn-cancel:hover {
                background: var(--color-dark-gray);
                color: var(--color-white);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .main-container {
                    padding: 1rem;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .header-actions {
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .modal-container {
                    max-width: 100%;
                    margin: 0;
                    border-radius: 0;
                    max-height: 100vh;
                }

                .modal-header {
                    border-radius: 0;
                }
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

            <div class="header-actions">
                <div class="user-menu">
                    <div class="user-avatar">U</div>
                    <span style="font-size: 0.875rem;">Administrator</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </header>

        <div class="main-container">
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Overview of registered households and beneficiaries</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <div class="alert-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <div class="alert-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>
                            @foreach($errors->all() as $error)
                                {{ $error }}@if(!$loop->last)<br>@endif
                            @endforeach
                        </span>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <!-- Total Households Card -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Registered Households</span>
                        <div class="stat-card-icon blue">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-value">{{ number_format($totalHouseholds) }}</div>
                    <div class="stat-card-change">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        <span>Total registered</span>
                    </div>
                </div>

                <!-- Total Household Members Card -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Household Members</span>
                        <div class="stat-card-icon gold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-value">{{ number_format($totalMembers) }}</div>
                    <div class="stat-card-change">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        <span>All members</span>
                    </div>
                </div>
            </div>

            <!-- Recent Households Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Household Registration List</h2>
                    <div class="section-actions">
                        <button type="button" class="btn btn-primary" onclick="openHouseholdModal()">Add Household</button>
                    </div>
                </div>
                
                @if($households->count() > 0)
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Father's Name</th>
                                    <th>Mother's Name</th>
                                    <th>Father's Occupation</th>
                                    <th>Mother's Occupation</th>
                                    <th>Home Address</th>
                                    <th>Family Income</th>
                                    <th>House Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($households as $household)
                                    <tr>
                                        <td>{{ $household->id }}</td>
                                        <td>{{ $household->father_name }}</td>
                                        <td>{{ $household->mother_name }}</td>
                                        <td>{{ $household->father_occupation }}</td>
                                        <td>{{ $household->mother_occupation }}</td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $household->home_address }}">{{ $household->home_address }}</td>
                                        <td>₱{{ number_format($household->family_income, 2) }}</td>
                                        <td>
                                            <span style="text-transform: capitalize; padding: 0.25rem 0.5rem; background: var(--color-light-gray); border-radius: 4px; font-size: 0.8125rem;">
                                                {{ str_replace('_', ' ', $household->house_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button type="button" 
                                                        class="btn btn-info btn-sm" 
                                                        onclick="openAddHouseholdMemberModal({{ $household->id }})"
                                                        data-household='@json($household)'>
                                                    Add Member
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-primary btn-sm" 
                                                        onclick="openViewHouseholdModal({{ $household->id }})"
                                                        data-household='@json($household)'
                                                        data-members='@json($household->members)'>
                                                    View
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-secondary btn-sm" 
                                                        onclick="openEditHouseholdModal({{ $household->id }})"
                                                        data-household='@json($household)'>
                                                    Edit
                                                </button>
                                                <form action="{{ route('households.destroy', $household) }}" method="POST" style="display: inline;" class="delete-household-form" data-household-id="{{ $household->id }}" data-household-name="{{ $household->father_name }} & {{ $household->mother_name }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-household-btn">Delete</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $households->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        <p>No household registrations found. Start by adding a new household.</p>
                    </div>
                @endif
            </div>

        </div>

        <footer>
            <p>&copy; {{ date('Y') }} Department of Labor and Employment (DOLE). All rights reserved.</p>
            <p style="margin-top: 0.5rem; font-size: 0.8125rem;">Household Beneficiary Tracking System - Official Government Portal</p>
        </footer>

        <!-- Add Household Modal -->
        <div id="householdModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
            <div class="modal-container" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h3 class="modal-title" id="householdModalTitle">Add New Household</h3>
                    <button type="button" class="modal-close" onclick="closeHouseholdModal()" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form id="householdForm" action="{{ route('households.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="householdFormMethod" value="POST">
                    <input type="hidden" name="household_id" id="household_id" value="">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="father_name">
                                    Father's Name <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="father_name" 
                                       name="father_name" 
                                       class="form-input" 
                                       required 
                                       value="{{ old('father_name') }}">
                                <span class="form-error"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="mother_name">
                                    Mother's Name <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="mother_name" 
                                       name="mother_name" 
                                       class="form-input" 
                                       required 
                                       value="{{ old('mother_name') }}">
                                <span class="form-error"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="father_occupation">
                                    Father's Occupation <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="father_occupation" 
                                       name="father_occupation" 
                                       class="form-input" 
                                       required 
                                       value="{{ old('father_occupation') }}">
                                <span class="form-error"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="mother_occupation">
                                    Mother's Occupation <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="mother_occupation" 
                                       name="mother_occupation" 
                                       class="form-input" 
                                       required 
                                       value="{{ old('mother_occupation') }}">
                                <span class="form-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="home_address">
                                Home Address <span class="required">*</span>
                            </label>
                            <textarea id="home_address" 
                                      name="home_address" 
                                      class="form-input form-textarea" 
                                      required>{{ old('home_address') }}</textarea>
                            <span class="form-error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="family_income">
                                Family Income (PHP) <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   id="family_income" 
                                   name="family_income" 
                                   class="form-input" 
                                   step="0.01" 
                                   min="0" 
                                   required 
                                   value="{{ old('family_income') }}">
                            <span class="form-error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                House Status <span class="required">*</span>
                            </label>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="radio" 
                                           id="house_status_rent" 
                                           name="house_status" 
                                           value="rent" 
                                           required 
                                           {{ old('house_status') == 'rent' ? 'checked' : '' }}>
                                    <label for="house_status_rent">Rent</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" 
                                           id="house_status_living_together_with_parents" 
                                           name="house_status" 
                                           value="living_together_with_parents" 
                                           {{ old('house_status') == 'living_together_with_parents' ? 'checked' : '' }}>
                                    <label for="house_status_living_together_with_parents">Living Together with Parents</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" 
                                           id="house_status_owned" 
                                           name="house_status" 
                                           value="owned" 
                                           {{ old('house_status') == 'owned' ? 'checked' : '' }}>
                                    <label for="house_status_owned">Owned</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" 
                                           id="house_status_others" 
                                           name="house_status" 
                                           value="others" 
                                           {{ old('house_status') == 'others' ? 'checked' : '' }}>
                                    <label for="house_status_others">Others</label>
                                </div>
                            </div>
                            <span class="form-error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" onclick="closeHouseholdModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="householdFormSubmit">Save Household</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Household Details Modal -->
        <div id="viewHouseholdModal" class="modal-overlay" onclick="closeViewModalOnOverlay(event)">
            <div class="modal-container" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h3 class="modal-title">Household Details</h3>
                    <button type="button" class="modal-close" onclick="closeViewHouseholdModal()" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div id="householdDetailsContent">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeViewHouseholdModal()">Close</button>
                </div>
            </div>
        </div>

        <!-- Add Household Member Modal -->
        <div id="addMemberModal" class="modal-overlay" onclick="closeAddMemberModalOnOverlay(event)">
            <div class="modal-container" onclick="event.stopPropagation()" style="max-width: 1000px;">
                <div class="modal-header">
                    <h3 class="modal-title">Add Household Members</h3>
                    <button type="button" class="modal-close" onclick="closeAddMemberModal()" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form id="memberForm" onsubmit="addMemberToTempStorage(event)">
                        <input type="hidden" id="memberHouseholdId" name="household_id" value="">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="member_name">
                                    Name of Child <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="member_name" 
                                       name="name_of_children" 
                                       class="form-input" 
                                       required>
                                <span class="form-error"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="member_birthdate">
                                    Birthdate <span class="required">*</span>
                                </label>
                                <input type="date" 
                                       id="member_birthdate" 
                                       name="birthdate" 
                                       class="form-input" 
                                       required
                                       onchange="calculateAge()">
                                <span class="form-error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="member_age">
                                    Age <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       id="member_age" 
                                       name="age" 
                                       class="form-input" 
                                       min="0" 
                                       max="150" 
                                       required>
                                <span class="form-error"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="member_sex">
                                    Sex <span class="required">*</span>
                                </label>
                                <select id="member_sex" 
                                        name="sex" 
                                        class="form-select" 
                                        required>
                                    <option value="">Select sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="form-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="member_civil_status">
                                Civil Status <span class="required">*</span>
                            </label>
                            <select id="member_civil_status" 
                                    name="civil_status" 
                                    class="form-select" 
                                    required>
                                <option value="">Select civil status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                            </select>
                            <span class="form-error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add to List</button>
                        </div>
                    </form>

                    <!-- Temporary Members List -->
                    <div id="tempMembersList" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--color-border);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="font-size: 1rem; font-weight: 600; color: var(--color-dole-blue);">Temporary Members List</h4>
                            <span id="memberCount" style="font-size: 0.875rem; color: var(--color-text-light);">0 member(s)</span>
                        </div>
                        <div id="tempMembersContainer" style="max-height: 300px; overflow-y: auto;">
                            <div class="empty-state" style="padding: 2rem 1rem;">
                                <p style="color: var(--color-text-light);">No members added yet. Add members using the form above.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="clearTempMembers()">Clear All</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddMemberModal()">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveMembersBtn" onclick="saveAllMembers()" disabled>Save All Members</button>
                </div>
            </div>
        </div>

        <script>
            function openHouseholdModal() {
                // Reset to add mode
                document.getElementById('householdModalTitle').textContent = 'Add New Household';
                document.getElementById('householdForm').action = '{{ route('households.store') }}';
                document.getElementById('householdFormMethod').value = 'POST';
                document.getElementById('household_id').value = '';
                document.getElementById('householdFormSubmit').textContent = 'Save Household';
                
                // Reset form
                document.getElementById('householdForm').reset();
                
                // Clear error states
                document.querySelectorAll('.form-group').forEach(group => {
                    group.classList.remove('has-error');
                });
                
                // Uncheck all radio buttons
                document.querySelectorAll('input[type="radio"][name="house_status"]').forEach(radio => {
                    radio.checked = false;
                });
                
                // Show modal
                document.getElementById('householdModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function openEditHouseholdModal(householdId) {
                // Find the button with this household ID
                const button = document.querySelector(`button[onclick="openEditHouseholdModal(${householdId})"]`);
                if (!button) return;

                // Get household data from data attribute
                const householdData = JSON.parse(button.getAttribute('data-household'));
                
                // Set to edit mode
                document.getElementById('householdModalTitle').textContent = 'Edit Household';
                document.getElementById('householdFormSubmit').textContent = 'Update Household';
                // Set form action to update route
                const baseUrl = '{{ url('/') }}';
                document.getElementById('householdForm').action = baseUrl + '/households/' + householdId;
                document.getElementById('householdFormMethod').value = 'PUT';
                document.getElementById('household_id').value = householdId;
                
                // Populate form fields
                document.getElementById('father_name').value = householdData.father_name || '';
                document.getElementById('mother_name').value = householdData.mother_name || '';
                document.getElementById('father_occupation').value = householdData.father_occupation || '';
                document.getElementById('mother_occupation').value = householdData.mother_occupation || '';
                document.getElementById('home_address').value = householdData.home_address || '';
                document.getElementById('family_income').value = householdData.family_income || '';
                
                // Set house status radio button
                const houseStatus = householdData.house_status || '';
                document.querySelectorAll('input[type="radio"][name="house_status"]').forEach(radio => {
                    radio.checked = (radio.value === houseStatus);
                });
                
                // Clear error states
                document.querySelectorAll('.form-group').forEach(group => {
                    group.classList.remove('has-error');
                });
                
                // Show modal
                document.getElementById('householdModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeHouseholdModal() {
                document.getElementById('householdModal').classList.remove('active');
                document.body.style.overflow = '';
                // Reset form
                document.getElementById('householdForm').reset();
                // Clear error states
                document.querySelectorAll('.form-group').forEach(group => {
                    group.classList.remove('has-error');
                });
            }

            function closeModalOnOverlay(event) {
                if (event.target === event.currentTarget) {
                    closeHouseholdModal();
                }
            }

            // Close modal on Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeHouseholdModal();
                }
            });

            // Handle form submission errors
            @if($errors->any())
                openHouseholdModal();
                @foreach($errors->getMessages() as $field => $messages)
                    @if($field === 'house_status')
                        // Handle radio button group
                        const houseStatusGroup = document.querySelector('input[name="{{ $field }}"]');
                        if (houseStatusGroup) {
                            const formGroup = houseStatusGroup.closest('.form-group');
                            formGroup.classList.add('has-error');
                            const errorSpan = formGroup.querySelector('.form-error');
                            if (errorSpan) {
                                errorSpan.textContent = '{{ $messages[0] }}';
                            }
                        }
                    @else
                        const {{ str_replace(['-', '.'], '_', $field) }}Field = document.getElementById('{{ $field }}');
                        if ({{ str_replace(['-', '.'], '_', $field) }}Field) {
                            {{ str_replace(['-', '.'], '_', $field) }}Field.closest('.form-group').classList.add('has-error');
                            const errorSpan = {{ str_replace(['-', '.'], '_', $field) }}Field.closest('.form-group').querySelector('.form-error');
                            if (errorSpan) {
                                errorSpan.textContent = '{{ $messages[0] }}';
                            }
                        }
                    @endif
                @endforeach
            @endif

            // Clear errors on input
            document.querySelectorAll('.form-input, .form-select, .form-textarea').forEach(input => {
                input.addEventListener('input', function() {
                    this.closest('.form-group').classList.remove('has-error');
                    const errorSpan = this.closest('.form-group').querySelector('.form-error');
                    if (errorSpan) {
                        errorSpan.textContent = '';
                    }
                });
            });

            // Clear errors on radio button change
            document.querySelectorAll('input[type="radio"][name="house_status"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const formGroup = this.closest('.form-group');
                    formGroup.classList.remove('has-error');
                    const errorSpan = formGroup.querySelector('.form-error');
                    if (errorSpan) {
                        errorSpan.textContent = '';
                    }
                });
            });

            // View Household Modal Functions
            function openViewHouseholdModal(householdId) {
                // Find the button with this household ID
                const button = document.querySelector(`button[onclick="openViewHouseholdModal(${householdId})"]`);
                if (!button) return;

                // Get household data from data attribute
                const householdData = JSON.parse(button.getAttribute('data-household'));
                
                // Format house status
                const houseStatus = householdData.house_status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                
                // Format family income
                const familyIncome = '₱' + parseFloat(householdData.family_income).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Format dates
                const createdAt = new Date(householdData.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                const updatedAt = new Date(householdData.updated_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Build HTML content
                const content = `
                    <div class="detail-group">
                        <div class="detail-row">
                            <div>
                                <div class="detail-label">Father's Name</div>
                                <div class="detail-value">${householdData.father_name || 'N/A'}</div>
                            </div>
                            <div>
                                <div class="detail-label">Mother's Name</div>
                                <div class="detail-value">${householdData.mother_name || 'N/A'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-row">
                            <div>
                                <div class="detail-label">Father's Occupation</div>
                                <div class="detail-value">${householdData.father_occupation || 'N/A'}</div>
                            </div>
                            <div>
                                <div class="detail-label">Mother's Occupation</div>
                                <div class="detail-value">${householdData.mother_occupation || 'N/A'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-label">Home Address</div>
                        <div class="detail-value">${householdData.home_address || 'N/A'}</div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-row">
                            <div>
                                <div class="detail-label">Family Income</div>
                                <div class="detail-value">${familyIncome}</div>
                            </div>
                            <div>
                                <div class="detail-label">House Status</div>
                                <div class="detail-value">
                                    <span style="text-transform: capitalize; padding: 0.25rem 0.75rem; background: var(--color-light-gray); border-radius: 4px; font-size: 0.875rem;">
                                        ${houseStatus}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <div class="detail-row">
                            <div>
                                <div class="detail-label">Registered Date</div>
                                <div class="detail-value">${createdAt}</div>
                            </div>
                            <div>
                                <div class="detail-label">Last Updated</div>
                                <div class="detail-value">${updatedAt}</div>
                            </div>
                        </div>
                    </div>
                `;

                // Get members data
                const membersData = JSON.parse(button.getAttribute('data-members') || '[]');
                
                // Build members list HTML
                let membersHtml = '';
                if (membersData && membersData.length > 0) {
                    membersHtml = `
                        <div class="detail-group">
                            <div class="detail-label" style="margin-bottom: 1rem;">Household Members (${membersData.length})</div>
                            <div style="max-height: 300px; overflow-y: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="background: var(--color-light-gray);">
                                            <th style="padding: 0.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-text);">Name</th>
                                            <th style="padding: 0.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-text);">Age</th>
                                            <th style="padding: 0.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-text);">Sex</th>
                                            <th style="padding: 0.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-text);">Civil Status</th>
                                            <th style="padding: 0.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--color-text);">Birthdate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    `;
                    
                    membersData.forEach((member, index) => {
                        const birthdate = new Date(member.birthdate).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                        const sex = member.sex === 'male' ? 'Male' : 'Female';
                        const civilStatus = member.civil_status.charAt(0).toUpperCase() + member.civil_status.slice(1);
                        
                        membersHtml += `
                            <tr style="border-top: 1px solid var(--color-border); ${index % 2 === 0 ? 'background: var(--color-white);' : 'background: var(--color-light-gray);'}">
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.875rem; color: var(--color-text); font-weight: 500;">${member.name_of_children}</td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.875rem; color: var(--color-text);">${member.age}</td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.875rem; color: var(--color-text);">${sex}</td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.875rem; color: var(--color-text);">${civilStatus}</td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.875rem; color: var(--color-text);">${birthdate}</td>
                            </tr>
                        `;
                    });
                    
                    membersHtml += `
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                } else {
                    membersHtml = `
                        <div class="detail-group">
                            <div class="detail-label">Household Members</div>
                            <div class="detail-value" style="color: var(--color-text-light); font-style: italic;">No members registered yet.</div>
                        </div>
                    `;
                }
                
                const fullContent = content + membersHtml;

                // Populate modal content
                document.getElementById('householdDetailsContent').innerHTML = fullContent;
                
                // Show modal
                document.getElementById('viewHouseholdModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeViewHouseholdModal() {
                document.getElementById('viewHouseholdModal').classList.remove('active');
                document.body.style.overflow = '';
            }

            function closeViewModalOnOverlay(event) {
                if (event.target === event.currentTarget) {
                    closeViewHouseholdModal();
                }
            }

            // Close view modal on Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const viewModal = document.getElementById('viewHouseholdModal');
                    if (viewModal && viewModal.classList.contains('active')) {
                        closeViewHouseholdModal();
                    }
                }
            });

            // Temporary Storage for Household Members
            function getTempMembersKey(householdId) {
                return `temp_members_${householdId}`;
            }

            function getTempMembers(householdId) {
                const key = getTempMembersKey(householdId);
                const stored = sessionStorage.getItem(key);
                return stored ? JSON.parse(stored) : [];
            }

            function saveTempMembers(householdId, members) {
                const key = getTempMembersKey(householdId);
                sessionStorage.setItem(key, JSON.stringify(members));
            }

            function addMemberToTempStorage(event) {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);
                const householdId = formData.get('household_id');
                
                const member = {
                    id: Date.now(), // Temporary ID
                    name_of_children: formData.get('name_of_children'),
                    birthdate: formData.get('birthdate'),
                    age: parseInt(formData.get('age')),
                    sex: formData.get('sex'),
                    civil_status: formData.get('civil_status'),
                    household_id: householdId
                };

                const members = getTempMembers(householdId);
                members.push(member);
                saveTempMembers(householdId, members);

                // Reset form
                form.reset();
                
                // Update display
                displayTempMembers(householdId);
            }

            function displayTempMembers(householdId) {
                const members = getTempMembers(householdId);
                const container = document.getElementById('tempMembersContainer');
                const countSpan = document.getElementById('memberCount');
                const saveBtn = document.getElementById('saveMembersBtn');

                countSpan.textContent = `${members.length} member(s)`;
                saveBtn.disabled = members.length === 0;

                if (members.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state" style="padding: 2rem 1rem;">
                            <p style="color: var(--color-text-light);">No members added yet. Add members using the form above.</p>
                        </div>
                    `;
                    return;
                }

                let html = '<div style="display: flex; flex-direction: column; gap: 0.75rem;">';
                members.forEach((member, index) => {
                    html += `
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--color-light-gray); border-radius: 6px; border: 1px solid var(--color-border);">
                            <div style="flex: 1;">
                                <div style="font-weight: 500; color: var(--color-text); margin-bottom: 0.25rem;">${member.name_of_children}</div>
                                <div style="font-size: 0.8125rem; color: var(--color-text-light);">
                                    ${member.age} years old, ${member.sex === 'male' ? 'Male' : 'Female'}, ${member.civil_status.charAt(0).toUpperCase() + member.civil_status.slice(1)}
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTempMember(${householdId}, ${member.id})" style="margin-left: 0.75rem;">
                                Remove
                            </button>
                        </div>
                    `;
                });
                html += '</div>';
                container.innerHTML = html;
            }

            function removeTempMember(householdId, memberId) {
                const members = getTempMembers(householdId);
                const filtered = members.filter(m => m.id !== memberId);
                saveTempMembers(householdId, filtered);
                displayTempMembers(householdId);
            }

            function clearTempMembers() {
                const householdId = document.getElementById('memberHouseholdId').value;
                if (householdId) {
                    const key = getTempMembersKey(householdId);
                    sessionStorage.removeItem(key);
                    displayTempMembers(householdId);
                }
            }

            function calculateAge() {
                const birthdate = document.getElementById('member_birthdate').value;
                if (birthdate) {
                    const today = new Date();
                    const birth = new Date(birthdate);
                    let age = today.getFullYear() - birth.getFullYear();
                    const monthDiff = today.getMonth() - birth.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                        age--;
                    }
                    document.getElementById('member_age').value = age;
                }
            }

            function openAddHouseholdMemberModal(householdId) {
                // Set household ID
                document.getElementById('memberHouseholdId').value = householdId;
                
                // Reset form
                document.getElementById('memberForm').reset();
                
                // Load and display temporary members
                displayTempMembers(householdId);
                
                // Show modal
                document.getElementById('addMemberModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeAddMemberModal() {
                document.getElementById('addMemberModal').classList.remove('active');
                document.body.style.overflow = '';
            }

            function closeAddMemberModalOnOverlay(event) {
                if (event.target === event.currentTarget) {
                    closeAddMemberModal();
                }
            }

            function saveAllMembers() {
                const householdId = document.getElementById('memberHouseholdId').value;
                const members = getTempMembers(householdId);

                if (members.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Members',
                        text: 'Please add at least one member before saving.',
                    });
                    return;
                }

                // Prepare data for submission
                const membersData = members.map(m => ({
                    name_of_children: m.name_of_children,
                    birthdate: m.birthdate,
                    age: m.age,
                    sex: m.sex,
                    civil_status: m.civil_status,
                    household_id: m.household_id
                }));

                // Show loading
                Swal.fire({
                    title: 'Saving...',
                    text: 'Please wait while we save the members.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit via fetch
                fetch('{{ route('household-members.bulk') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        members: membersData
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Failed to save members');
                        }).catch(() => {
                            throw new Error('Failed to save members. Please try again.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success !== false) {
                        // Clear temporary storage
                        const key = getTempMembersKey(householdId);
                        sessionStorage.removeItem(key);
                        
                        // Close modal
                        closeAddMemberModal();
                        
                        // Show success and reload
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message || `${members.length} member(s) saved successfully.`,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Failed to save members');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Failed to save members. Please try again.',
                    });
                });
            }

            // Handle delete household with SweetAlert
            document.querySelectorAll('.delete-household-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const householdName = form.getAttribute('data-household-name');
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete the household: ${householdName}. This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#EF4444',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: 'Deleting...',
                                text: 'Please wait while we delete the household.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            
                            // Submit the form
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </body>
</html>

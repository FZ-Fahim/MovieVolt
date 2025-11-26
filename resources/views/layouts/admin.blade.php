<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MovieVault Admin Panel')</title>
    <meta name="description" content="@yield('description', 'Admin panel for managing MovieVault movies')">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --admin-primary: #dc2626;
            --admin-secondary: #1f2937;
            --admin-accent: #3b82f6;
            --admin-success: #10b981;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-dark: #111827;
            --admin-light: #f9fafb;
            --admin-border: #e5e7eb;
        }

        body {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: #f9fafb;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Admin Header */
        .admin-header {
            background: linear-gradient(135deg, #111827 0%, #000000 100%);
            padding: 1.5rem 0;
            border-bottom: 3px solid var(--admin-primary);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .admin-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(45deg, #dc2626, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-subtitle {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Admin Navigation */
        .admin-nav {
            background: rgba(31, 41, 55, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #374151;
        }

        .admin-nav-btn {
            background: linear-gradient(45deg, #374151, #4b5563);
            border: none;
            padding: 0.75rem 1.5rem;
            margin: 0 0.5rem;
            border-radius: 8px;
            color: #f9fafb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .admin-nav-btn:hover {
            background: linear-gradient(45deg, #dc2626, #ef4444);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
            color: white;
        }

        .admin-nav-btn.active {
            background: linear-gradient(45deg, #dc2626, #ef4444);
            color: white;
        }

        /* Admin Content */
        .admin-content {
            background: rgba(31, 41, 55, 0.8);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid #374151;
            backdrop-filter: blur(10px);
        }

        .admin-card {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            border-color: var(--admin-primary);
        }

        /* Form Styling */
        .form-control, .form-select, .form-control:focus, .form-select:focus {
            background: rgba(55, 65, 81, 0.8);
            border: 2px solid #4b5563;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: #f9fafb;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(55, 65, 81, 1);
            border-color: var(--admin-primary);
            color: #f9fafb;
            box-shadow: 0 0 0 0.25rem rgba(220, 38, 38, 0.15);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-select option {
            background: #374151;
            color: #f9fafb;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #d1d5db;
        }

        /* Buttons */
        .btn-admin-primary {
            background: linear-gradient(45deg, var(--admin-primary), #ef4444);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-admin-primary:hover {
            background: linear-gradient(45deg, #b91c1c, var(--admin-primary));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
            color: white;
        }

        .btn-admin-secondary {
            background: linear-gradient(45deg, #374151, #4b5563);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            color: #f9fafb;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-admin-secondary:hover {
            background: linear-gradient(45deg, #4b5563, #6b7280);
            transform: translateY(-2px);
            color: white;
        }

        .btn-admin-danger {
            background: linear-gradient(45deg, #dc2626, #ef4444);
            border: none;
            color: white;
            font-weight: 600;
        }

        .btn-admin-danger:hover {
            background: linear-gradient(45deg, #b91c1c, #dc2626);
            color: white;
        }

        /* Table Styling */
        .table {
            background: rgba(31, 41, 55, 0.8);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #374151;
        }

        .table th {
            background: linear-gradient(135deg, #111827, #1f2937);
            border-bottom: 2px solid var(--admin-primary);
            color: #f9fafb;
            font-weight: 700;
            padding: 1rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            background: rgba(31, 41, 55, 0.6);
            color: #d1d5db;
            padding: 1rem;
            border-bottom: 1px solid #374151;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(55, 65, 81, 0.8);
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(45deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
            color: #10b981;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: linear-gradient(45deg, rgba(239, 68, 68, 0.2), rgba(220, 38, 38, 0.2));
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #9ca3af;
            font-size: 1rem;
        }

        /* Stats Cards */
        .stat-card {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--admin-primary);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--admin-primary);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #f9fafb;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* Footer */
        .admin-footer {
            background: rgba(17, 24, 39, 0.8);
            padding: 1.5rem 0;
            margin-top: 3rem;
            border-top: 1px solid #374151;
            text-align: center;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-title {
                font-size: 1.5rem;
            }
            
            .admin-nav-btn {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
                margin: 0.25rem;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="admin-title mb-0">
                        <i class="fas fa-shield-alt me-2"></i>MovieVault Admin
                    </h1>
                    <p class="admin-subtitle mb-0">Content Management System</p>
                </div>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-admin-secondary btn-sm" target="_blank">
                        <i class="fas fa-external-link-alt me-1"></i>View Public Site
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Navigation -->
    <nav class="admin-nav">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center">
                <a href="{{ route('admin.movies.index') }}" class="admin-nav-btn {{ request()->routeIs('admin.movies.index') ? 'active' : '' }}">
                    <i class="fas fa-list me-1"></i>All Movies
                </a>
                <a href="{{ route('admin.movies.create') }}" class="admin-nav-btn {{ request()->routeIs('admin.movies.create') ? 'active' : '' }}">
                    <i class="fas fa-plus me-1"></i>Add Movie
                </a>
                <a href="{{ route('admin.movies.index') }}?filter=recent" class="admin-nav-btn">
                    <i class="fas fa-clock me-1"></i>Recent
                </a>
                <a href="{{ route('admin.movies.index') }}?filter=popular" class="admin-nav-btn">
                    <i class="fas fa-fire me-1"></i>Popular
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Admin Footer -->
    <footer class="admin-footer">
        <div class="container">
            <p class="mb-0">
                <small>&copy; {{ date('Y') }} MovieVault Admin Panel. Secure content management system.</small>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Admin JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Confirm delete actions
        document.querySelectorAll('.btn-admin-danger[data-confirm]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });

        // Form validation highlights
        document.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.addEventListener('invalid', function() {
                this.style.borderColor = '#ef4444';
            });
            
            input.addEventListener('input', function() {
                if (this.validity.valid) {
                    this.style.borderColor = '#4b5563';
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>

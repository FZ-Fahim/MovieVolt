<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MovieVault - Download Movies')</title>
    <meta name="description" content="@yield('description', 'Download the latest movies in high quality from MovieVault')">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-red: #e50914;
            --accent-blue: #00b4d8;
            --accent-pink: #e91e63;
            --accent-green: #4caf50;
            --accent-orange: #ff9800;
            --dark-bg: #0f0f0f;
            --card-bg: #1a1a1a;
            --text-white: #ffffff;
            --text-gray: #b3b3b3;
        }

        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            color: var(--text-white);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .main-header {
            background: linear-gradient(135deg, #141414 0%, #000000 100%);
            padding: 2rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .main-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(229, 9, 20, 0.1) 0%, transparent 70%);
        }

        .main-title {
            font-size: 4.5rem;
            font-weight: 900;
            background: linear-gradient(45deg, #e50914, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .main-subtitle {
            color: var(--text-gray);
            font-size: 1.2rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        /* Navigation */
        .navbar {
            background: rgba(20, 20, 20, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--primary-red);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--primary-red), var(--accent-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Category Navigation */
        .category-nav {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 1.5rem 0;
            margin: 2rem 0;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .category-btn {
            background: linear-gradient(45deg, var(--primary-red), var(--accent-pink));
            border: none;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
        }

        .category-btn.action { background: linear-gradient(45deg, #ff6b6b, #ee5a52); }
        .category-btn.comedy { background: linear-gradient(45deg, #4ecdc4, #44a08d); }
        .category-btn.drama { background: linear-gradient(45deg, #a8edea, #fed6e3); color: #333; }
        .category-btn.horror { background: linear-gradient(45deg, #434343, #000000); }
        .category-btn.sci-fi { background: linear-gradient(45deg, #667eea, #764ba2); }
        .category-btn.thriller { background: linear-gradient(45deg, #f093fb, #f5576c); }

        /* Search Section */
        .search-section {
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
            padding: 2.5rem;
            border-radius: 20px;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(229, 9, 20, 0.05), rgba(0, 180, 216, 0.05));
        }

        .search-wrapper {
            position: relative;
            display: flex;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid transparent;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .search-wrapper:focus-within {
            border-color: var(--primary-red);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 25px rgba(229, 9, 20, 0.3);
        }

        .search-input {
            background: transparent;
            border: none;
            padding: 1.2rem 2rem;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            outline: none;
        }

        .search-input::placeholder {
            color: var(--text-gray);
        }

        .search-btn {
            background: linear-gradient(45deg, var(--primary-red), #dc2626);
            border: none;
            padding: 1.2rem 2rem;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
        }

        /* Status Buttons */
        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .status-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .status-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .status-btn:hover::before {
            left: 100%;
        }

        .status-btn.new {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            color: white;
        }

        .status-btn.hot {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            color: white;
        }

        .status-btn.anime {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            color: white;
        }

        .status-btn.watched {
            background: linear-gradient(45deg, #10b981, #059669);
            color: white;
        }

        /* Quick Download Button */
        .quick-download-btn {
            background: linear-gradient(45deg, #b45309, #d97706);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(185, 83, 9, 0.3);
            transition: all 0.3s ease;
            display: inline-block;
        }

        .quick-download-btn:hover {
            background: linear-gradient(45deg, #92400e, #b45309);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(185, 83, 9, 0.4);
            color: white;
        }

        /* Movie Cards */
        .movie-card {
            background: linear-gradient(135deg, #1c1c1c 0%, #2a2a2a 100%);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            border: 1px solid #333;
        }

        .movie-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(229, 9, 20, 0.15);
            border-color: var(--primary-red);
        }

        .movie-poster {
            position: relative;
            overflow: hidden;
        }

        .movie-card .card-img-top {
            height: 400px;
            object-fit: cover;
            transition: all 0.3s ease;
            width: 100%;
        }

        .movie-card:hover .card-img-top {
            transform: scale(1.03);
        }

        .movie-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent 60%, rgba(0,0,0,0.8) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .movie-card:hover .movie-overlay {
            opacity: 1;
        }

        .quality-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .year-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .movie-card .card-body {
            padding: 1.5rem;
            position: relative;
        }

        .movie-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.8rem;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .movie-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .meta-badge {
            background: linear-gradient(45deg, var(--primary-red), #dc2626);
            padding: 0.3rem 0.8rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-badge.genre {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
        }

        .meta-badge.language {
            background: linear-gradient(45deg, #10b981, #059669);
        }

        .movie-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: #bbb;
        }

        .download-count {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .file-size {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .movie-description {
            color: #ccc;
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .movie-actions {
            display: flex;
            gap: 0.5rem;
        }

        .download-btn {
            background: linear-gradient(45deg, #dc2626, #ef4444);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            flex: 1;
            font-size: 0.85rem;
        }

        .download-btn:hover {
            background: linear-gradient(45deg, #b91c1c, #dc2626);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
        }

        .details-btn {
            background: rgba(255,255,255,0.1);
            border: 1px solid #555;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            color: #ccc;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .details-btn:hover {
            background: rgba(255,255,255,0.2);
            border-color: var(--primary-red);
            color: white;
        }

        /* Trending Section */
        .trending-section {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 50%, #7f1d1d 100%);
            padding: 2.5rem;
            border-radius: 15px;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .trending-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 6s ease-in-out infinite;
        }

        .trending-title {
            font-size: 2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #4b5563;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-red);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(45deg, var(--primary-red), #f59e0b);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--primary-red);
            margin-bottom: 1rem;
        }

        .stat-content h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-content p {
            color: #9ca3af;
            margin: 0;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Filters */
        .filter-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            border: 1px solid #333;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-red);
            color: white;
            box-shadow: 0 0 15px rgba(229, 9, 20, 0.3);
        }

        .form-select option {
            background: #1a1a1a;
            color: white;
        }

        .form-label {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        /* Fix text visibility issues */
        .text-muted {
            color: #b3b3b3 !important;
        }

        .badge {
            color: white;
        }

        /* Ensure all text in filter section is visible */
        .filter-section h4,
        .filter-section label,
        .filter-section .form-label {
            color: white;
        }

        /* Movie grid improvements */
        #movies-grid {
            margin-top: 2rem;
        }

        /* Ensure proper grid layout */
        .movie-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .movie-card .card-body {
            flex: 1;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <h1 class="main-title">
                <i class="fas fa-film me-3"></i>MovieVault
            </h1>
            <p class="main-subtitle">Your ultimate destination for movie downloads</p>
            
            <!-- Search Section -->
            <div class="search-section">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <form method="GET" action="{{ route('movies.search') }}">
                            <div class="search-wrapper">
                                <input type="search" name="search" class="search-input" 
                                       placeholder="🔍 সার্চ করে খুঁজে নিন আপনার পছন্দের মুভি ও সিরিজ..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        
                        <!-- Status Buttons -->
                        <div class="status-buttons mt-3">
                            <a href="{{ route('movies.search', ['year' => date('Y')]) }}" class="status-btn new">
                                <i class="fas fa-plus-circle me-1"></i> NEW
                            </a>
                            <a href="{{ route('movies.search', ['genre' => 'Action']) }}" class="status-btn hot">
                                <i class="fas fa-fire me-1"></i> HOT NOW
                            </a>
                            <a href="{{ route('movies.search', ['quality' => '4K']) }}" class="status-btn anime">
                                <i class="fas fa-star me-1"></i> 4K/UHD
                            </a>
                            <a href="#" class="status-btn watched">
                                <i class="fas fa-eye me-1"></i> MOST WATCHED
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Download Button -->
                <div class="text-center mt-4">
                    <a href="#movies-grid" class="quick-download-btn">
                        <i class="fas fa-download me-2"></i>ডাউনলোড করার নিয়ম
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="category-nav w-100">
                <div class="text-center">
                    <a href="{{ route('home') }}" class="category-btn">
                        <i class="fas fa-home me-1"></i> HOME
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Action']) }}" class="category-btn action">
                        <i class="fas fa-fist-raised me-1"></i> ACTION
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Comedy']) }}" class="category-btn comedy">
                        <i class="fas fa-laugh me-1"></i> COMEDY
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Drama']) }}" class="category-btn drama">
                        <i class="fas fa-theater-masks me-1"></i> DRAMA
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Horror']) }}" class="category-btn horror">
                        <i class="fas fa-ghost me-1"></i> HORROR
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Sci-Fi']) }}" class="category-btn sci-fi">
                        <i class="fas fa-robot me-1"></i> SCI-FI
                    </a>
                    <a href="{{ route('movies.search', ['genre' => 'Thriller']) }}" class="category-btn thriller">
                        <i class="fas fa-eye me-1"></i> THRILLER
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-primary">
                        <i class="fas fa-film me-2"></i>MovieVault
                    </h5>
                    <p class="mb-0">Your ultimate destination for movie downloads.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <small>&copy; {{ date('Y') }} MovieVault. All rights reserved.</small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add loading animation for download buttons
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Preparing Download...';
                this.disabled = true;
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>

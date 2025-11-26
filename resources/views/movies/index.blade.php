@extends('layouts.app')

@section('title', 'MovieVault - Download Latest Movies')
@section('description', 'Browse and download the latest movies in high quality from MovieVault')

@section('content')
<!-- Trending Section -->
<div class="trending-section">
    <div class="row">
        <div class="col-md-6">
            <h2 class="trending-title">
                <i class="fas fa-fire me-2"></i> TRENDING NOW
            </h2>
            <p class="text-white-50">Latest and most popular movies</p>
        </div>
        <div class="col-md-6">
            <h2 class="trending-title">
                <i class="fas fa-clock me-2"></i> RECENTLY UPDATED
            </h2>
            <p class="text-white-50">Newest additions to our collection</p>
        </div>
    </div>
</div>

<!-- Movie Status Cards -->
<div class="row mb-4">
    <div class="col-12">
        <div class="row g-3">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="stat-content">
                        <h4>{{ $movies->total() }}+</h4>
                        <p>Total Movies</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="stat-content">
                        <h4>50+</h4>
                        <p>Trending</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hd-video"></i>
                    </div>
                    <div class="stat-content">
                        <h4>4K/HD</h4>
                        <p>Quality</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Free</h4>
                        <p>Downloads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Filters Section -->
    <div class="col-12">
        <div class="filter-section">
            <h4 class="mb-4"><i class="fas fa-filter me-2"></i>Filters</h4>
            <form method="GET" action="{{ route('home') }}">
                <div class="row g-4">
                    <div class="col-md-2">
                        <label class="form-label">Genre</label>
                        <select name="genre" class="form-select">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Year</label>
                        <select name="year" class="form-select">
                            <option value="">All Years</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quality</label>
                        <select name="quality" class="form-select">
                            <option value="">All Qualities</option>
                            @foreach($qualities as $quality)
                                <option value="{{ $quality }}" {{ request('quality') == $quality ? 'selected' : '' }}>
                                    {{ $quality }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Language</label>
                        <select name="language" class="form-select">
                            <option value="">All Languages</option>
                            @foreach($languages as $language)
                                <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </div>
                @if(request()->hasAny(['search', 'genre', 'year', 'quality', 'language']))
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-light">
                            <i class="fas fa-times me-2"></i>Clear All Filters
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Results Info -->
    <div class="col-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                @if(request('search'))
                    Search Results for "{{ request('search') }}"
                @else
                    Latest Movies
                @endif
                <span class="badge bg-primary ms-2">{{ $movies->total() }} movies</span>
            </h4>
            
            <div class="text-muted">
                Showing {{ $movies->firstItem() ?? 0 }} - {{ $movies->lastItem() ?? 0 }} of {{ $movies->total() }} results
            </div>
        </div>
    </div>

    <!-- Movies Grid -->
    <div id="movies-grid" class="row">
    @if($movies->count() > 0)
        @foreach($movies as $movie)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="movie-card h-100">
                    <div class="movie-poster">
                        <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="movie-overlay"></div>
                        
                        @if($movie->quality)
                            <div class="quality-badge">{{ $movie->quality }}</div>
                        @endif
                        
                        @if($movie->release_year)
                            <div class="year-badge">{{ $movie->release_year }}</div>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="movie-title">{{ $movie->title }}</h6>
                        
                        <div class="movie-meta">
                            @if($movie->genre)
                                <span class="meta-badge genre">{{ $movie->genre }}</span>
                            @endif
                            @if($movie->language)
                                <span class="meta-badge language">{{ $movie->language }}</span>
                            @endif
                        </div>

                        <div class="movie-stats">
                            <div class="download-count">
                                <i class="fas fa-download"></i>
                                <span>{{ number_format($movie->downloads) }}</span>
                            </div>
                            @if($movie->file_size)
                                <div class="file-size">
                                    <i class="fas fa-file"></i>
                                    <span>{{ $movie->formatted_file_size }}</span>
                                </div>
                            @endif
                        </div>

                        @if($movie->description)
                            <p class="movie-description">{{ $movie->description }}</p>
                        @endif

                        <div class="movie-actions mt-auto">
                            @if($movie->download_link)
                                <a href="{{ route('movies.download', $movie) }}" 
                                   class="download-btn"
                                   onclick="return confirm('Start download for {{ $movie->title }}?')">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            @endif
                            <a href="{{ route('movies.show', $movie) }}" class="details-btn">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <!-- No Movies Found -->
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-film text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">No Movies Found</h4>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'genre', 'year', 'quality']))
                        Try adjusting your filters or search terms.
                    @else
                        Check back later for new movie releases.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'genre', 'year', 'quality']))
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>View All Movies
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>

<!-- Pagination -->
@if($movies->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $movies->withQueryString()->links() }}
    </div>
@endif

<!-- Language Selection Section -->
<div class="language-section mt-5">
    <div class="text-center mb-4">
        <h3 class="language-title">
            <i class="fas fa-globe me-2"></i>Browse by Language
        </h3>
        <p class="text-muted">Explore movies in different languages</p>
    </div>
    
    <div class="row g-3">
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'English']) }}" class="language-card english">
                <div class="language-flag">🇺🇸</div>
                <div class="language-name">English</div>
                <div class="language-count">{{ $movies->where('language', 'English')->count() }}+ Movies</div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'Hindi']) }}" class="language-card hindi">
                <div class="language-flag">🇮🇳</div>
                <div class="language-name">Hindi</div>
                <div class="language-count">{{ $movies->where('language', 'Hindi')->count() }}+ Movies</div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'Bengali']) }}" class="language-card bengali">
                <div class="language-flag">🇧🇩</div>
                <div class="language-name">Bengali</div>
                <div class="language-count">{{ $movies->where('language', 'Bengali')->count() }}+ Movies</div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'Tamil']) }}" class="language-card tamil">
                <div class="language-flag">🏴</div>
                <div class="language-name">Tamil</div>
                <div class="language-count">{{ $movies->where('language', 'Tamil')->count() }}+ Movies</div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'Korean']) }}" class="language-card korean">
                <div class="language-flag">🇰🇷</div>
                <div class="language-name">Korean</div>
                <div class="language-count">{{ $movies->where('language', 'Korean')->count() }}+ Movies</div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-6">
            <a href="{{ route('movies.search', ['language' => 'Japanese']) }}" class="language-card japanese">
                <div class="language-flag">🇯🇵</div>
                <div class="language-name">Japanese</div>
                <div class="language-count">{{ $movies->where('language', 'Japanese')->count() }}+ Movies</div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .pagination {
        --bs-pagination-bg: var(--secondary-color);
        --bs-pagination-border-color: #333;
        --bs-pagination-color: var(--text-light);
        --bs-pagination-hover-bg: var(--primary-color);
        --bs-pagination-hover-border-color: var(--primary-color);
        --bs-pagination-active-bg: var(--primary-color);
        --bs-pagination-active-border-color: var(--primary-color);
    }
</style>
@endsection

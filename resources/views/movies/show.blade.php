@extends('layouts.app')

@section('title', $movie->title . ' - Download | MovieVault')
@section('description', 'Download ' . $movie->title . ' (' . $movie->release_year . ') in high quality from MovieVault')

@section('content')
<div class="row">
    <!-- Movie Details -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <img src="{{ $movie->poster }}" class="card-img-top movie-poster" alt="{{ $movie->title }}">
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h1 class="card-title h3">{{ $movie->title }}</h1>
                    <div>
                        @if($movie->genre)
                            <span class="badge bg-secondary me-1">{{ $movie->genre }}</span>
                        @endif
                        @if($movie->quality)
                            <span class="badge bg-success me-1">{{ $movie->quality }}</span>
                        @endif
                    </div>
                </div>

                <!-- Movie Info -->
                <div class="row mb-4">
                    @if($movie->release_year)
                        <div class="col-md-6 mb-2">
                            <strong><i class="fas fa-calendar text-primary me-2"></i>Release Year:</strong>
                            {{ $movie->release_year }}
                        </div>
                    @endif
                    
                    @if($movie->language)
                        <div class="col-md-6 mb-2">
                            <strong><i class="fas fa-language text-primary me-2"></i>Language:</strong>
                            {{ $movie->language }}
                        </div>
                    @endif
                    
                    @if($movie->file_size)
                        <div class="col-md-6 mb-2">
                            <strong><i class="fas fa-file text-primary me-2"></i>File Size:</strong>
                            {{ $movie->formatted_file_size }}
                        </div>
                    @endif
                    
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-download text-primary me-2"></i>Downloads:</strong>
                        {{ number_format($movie->downloads) }}
                    </div>
                </div>

                <!-- Description -->
                @if($movie->description)
                    <div class="mb-4">
                        <h5><i class="fas fa-info-circle text-primary me-2"></i>Description</h5>
                        <p class="text-muted">{{ $movie->description }}</p>
                    </div>
                @endif

                <!-- Download Section -->
                <div class="download-section">
                    <h5><i class="fas fa-download text-primary me-2"></i>Download</h5>
                    @if($movie->download_link)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Click the download button below to start downloading <strong>{{ $movie->title }}</strong>.
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex">
                            <a href="{{ route('movies.download', $movie) }}" 
                               class="btn btn-primary btn-lg download-btn me-md-2"
                               onclick="return confirm('Start download for {{ $movie->title }}?')">
                                <i class="fas fa-download me-2"></i>Download Now
                            </a>
                            
                            <button type="button" class="btn btn-outline-light" 
                                    onclick="navigator.share({title: '{{ $movie->title }}', url: window.location.href}) || copyToClipboard(window.location.href)">
                                <i class="fas fa-share me-2"></i>Share
                            </button>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Download link not available for this movie.
                        </div>
                    @endif
                </div>

                <!-- Back Button -->
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Movies
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Similar Movies -->
@if($similarMovies->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h4><i class="fas fa-film text-primary me-2"></i>Similar Movies</h4>
        </div>
        
        @foreach($similarMovies as $similarMovie)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                <div class="card h-100">
                    <img src="{{ $similarMovie->poster }}" class="card-img-top" 
                         style="height: 200px; object-fit: cover;" alt="{{ $similarMovie->title }}">
                    <div class="card-body p-2">
                        <h6 class="card-title small mb-1">{{ Str::limit($similarMovie->title, 30) }}</h6>
                        @if($similarMovie->release_year)
                            <small class="text-muted">{{ $similarMovie->release_year }}</small>
                        @endif
                        <div class="d-grid mt-2">
                            <a href="{{ route('movies.show', $similarMovie) }}" 
                               class="btn btn-outline-light btn-sm">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

@section('scripts')
<script>
    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link copied to clipboard!');
        }).catch(function() {
            console.log('Copy failed');
        });
    }

    // Add download tracking
    document.addEventListener('DOMContentLoaded', function() {
        const downloadBtn = document.querySelector('.download-btn');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', function() {
                // You can add analytics tracking here
                console.log('Download started for: {{ $movie->title }}');
            });
        }
    });
</script>
@endsection

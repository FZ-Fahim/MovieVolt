@extends('layouts.admin')

@section('title', $movie->title . ' - MovieVault Admin')

@section('content')
<div class="admin-content">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="page-title">
                    <i class="fas fa-eye me-2"></i>{{ $movie->title }}
                </h2>
                <p class="page-subtitle">Movie details and information</p>
            </div>
            <div>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-admin-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <a href="{{ route('admin.movies.edit', $movie) }}" class="btn btn-admin-primary">
                    <i class="fas fa-edit me-2"></i>Edit Movie
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="admin-card">
                <h5 class="mb-3">Movie Poster</h5>
                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" 
                     class="img-fluid rounded shadow-sm" style="width: 100%; max-width: 300px;">
                
                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Downloads:</span>
                        <strong>{{ number_format($movie->downloads) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status:</span>
                        <span class="badge {{ $movie->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $movie->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Created:</span>
                        <span>{{ $movie->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="admin-card">
                <h5 class="mb-3">Movie Information</h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Title</label>
                        <p class="mb-0">{{ $movie->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Slug</label>
                        <p class="mb-0"><code>{{ $movie->slug }}</code></p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted">Genre</label>
                        <p class="mb-0">
                            @if($movie->genre)
                                <span class="badge bg-secondary">{{ $movie->genre }}</span>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">Release Year</label>
                        <p class="mb-0">{{ $movie->release_year ?? 'Not specified' }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted">Language</label>
                        <p class="mb-0">{{ $movie->language ?? 'Not specified' }}</p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Quality</label>
                        <p class="mb-0">{{ $movie->quality ?? 'Not specified' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">File Size</label>
                        <p class="mb-0">{{ $movie->file_size ?? 'Not specified' }}</p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Description</label>
                    <p class="mb-0">{{ $movie->description ?? 'No description provided.' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Download Link</label>
                    <p class="mb-0">
                        <a href="{{ $movie->download_link }}" target="_blank" class="text-primary">
                            {{ $movie->download_link }}
                        </a>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Poster URL</label>
                    <p class="mb-0">
                        @if($movie->poster_url)
                            <a href="{{ $movie->poster_url }}" target="_blank" class="text-primary">
                                {{ $movie->poster_url }}
                            </a>
                        @else
                            <span class="text-muted">Using default poster</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="admin-card">
                <h5 class="mb-3">Public View</h5>
                <p class="text-muted mb-3">This is how your movie appears to visitors:</p>
                <a href="{{ route('movies.show', $movie) }}" target="_blank" class="btn btn-admin-accent">
                    <i class="fas fa-external-link-alt me-2"></i>View on Public Site
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

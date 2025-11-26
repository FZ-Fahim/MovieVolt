@extends('layouts.admin')

@section('title', 'Add New Movie - MovieVault Admin')

@section('content')
<div class="admin-content">
    <div class="page-header">
        <h2 class="page-title">
            <i class="fas fa-plus me-2"></i>Add New Movie
        </h2>
        <p class="page-subtitle">Add a new movie to your collection</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="admin-card">
                <form action="{{ route('admin.movies.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Movie Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="release_year" class="form-label">Release Year</label>
                                    <input type="number" class="form-control @error('release_year') is-invalid @enderror" 
                                           id="release_year" name="release_year" value="{{ old('release_year') }}" 
                                           min="1900" max="{{ date('Y') }}">
                                    @error('release_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="genre" class="form-label">Genre</label>
                                    <input type="text" class="form-control @error('genre') is-invalid @enderror" 
                                           id="genre" name="genre" value="{{ old('genre') }}" 
                                           placeholder="e.g., Action, Drama, Comedy">
                                    @error('genre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="language" class="form-label">Language</label>
                                    <input type="text" class="form-control @error('language') is-invalid @enderror" 
                                           id="language" name="language" value="{{ old('language') }}" 
                                           placeholder="e.g., English, Spanish">
                                    @error('language')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="quality" class="form-label">Quality</label>
                                    <select class="form-select @error('quality') is-invalid @enderror" id="quality" name="quality">
                                        <option value="">Select Quality</option>
                                        <option value="480p" {{ old('quality') == '480p' ? 'selected' : '' }}>480p</option>
                                        <option value="720p" {{ old('quality') == '720p' ? 'selected' : '' }}>720p</option>
                                        <option value="1080p" {{ old('quality') == '1080p' ? 'selected' : '' }}>1080p</option>
                                        <option value="4K" {{ old('quality') == '4K' ? 'selected' : '' }}>4K</option>
                                    </select>
                                    @error('quality')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="poster_url" class="form-label">Poster URL</label>
                                    <input type="url" class="form-control @error('poster_url') is-invalid @enderror" 
                                           id="poster_url" name="poster_url" value="{{ old('poster_url') }}" 
                                           placeholder="https://example.com/poster.jpg">
                                    @error('poster_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_size" class="form-label">File Size</label>
                                    <input type="text" class="form-control @error('file_size') is-invalid @enderror" 
                                           id="file_size" name="file_size" value="{{ old('file_size') }}" 
                                           placeholder="e.g., 1.5 GB">
                                    @error('file_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="download_link" class="form-label">Download Link *</label>
                            <input type="url" class="form-control @error('download_link') is-invalid @enderror" 
                                   id="download_link" name="download_link" value="{{ old('download_link') }}" 
                                   placeholder="https://example.com/download/movie.mp4" required>
                            @error('download_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (visible to public)
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Movie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

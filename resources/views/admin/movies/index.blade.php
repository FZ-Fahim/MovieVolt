@extends('layouts.admin')

@section('title', 'Manage Movies - MovieVault Admin')

@section('content')
<div class="admin-content">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="page-title">
                    <i class="fas fa-film me-2"></i>Movie Management
                </h2>
                <p class="page-subtitle">Manage your movie collection and content</p>
            </div>
            <div>
                <a href="{{ route('admin.movies.create') }}" class="btn btn-admin-primary">
                    <i class="fas fa-plus me-2"></i>Add New Movie
                </a>
            </div>
        </div>    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-film"></i>
                </div>
                <div class="stat-number">{{ $totalMovies }}</div>
                <div class="stat-label">Total Movies</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-number">{{ $activeMovies }}</div>
                <div class="stat-label">Active</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stat-number">{{ number_format($totalDownloads) }}</div>
                <div class="stat-label">Downloads</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-number">{{ $thisWeekMovies }}</div>
                <div class="stat-label">This Week</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Year</th>
                        <th>Quality</th>
                        <th>Status</th>
                        <th>Downloads</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td>
                                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" 
                                         class="img-thumbnail" style="width: 50px; height: 75px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $movie->title }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($movie->description, 50) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $movie->genre }}</span>
                                </td>
                                <td>{{ $movie->release_year }}</td>
                                <td>{{ $movie->quality }}</td>
                                <td>
                                    <span class="badge {{ $movie->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $movie->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ number_format($movie->downloads) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.movies.show', $movie) }}" 
                                           class="btn btn-sm btn-admin-secondary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.movies.edit', $movie) }}" 
                                           class="btn btn-sm btn-admin-primary" title="Edit Movie">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.movies.destroy', $movie) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-admin-danger" 
                                                    data-confirm="true" title="Delete Movie">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="fas fa-film text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 mb-0">No Movies Found</h5>
                                    <p class="text-muted">Start by adding your first movie to the collection.</p>
                                    <a href="{{ route('admin.movies.create') }}" class="btn btn-admin-primary">
                                        <i class="fas fa-plus me-2"></i>Add First Movie
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($movies->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $movies->links() }}
            </div>
        @endif
    </div>
@endsection

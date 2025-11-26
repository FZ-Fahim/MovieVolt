<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of movies for admin.
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(20);
        
        // Get statistics for the dashboard
        $totalMovies = Movie::count();
        $activeMovies = Movie::where('is_active', true)->count();
        $totalDownloads = Movie::sum('downloads');
        $thisWeekMovies = Movie::where('created_at', '>=', now()->subDays(7))->count();
        
        return view('admin.movies.index', compact(
            'movies', 
            'totalMovies', 
            'activeMovies', 
            'totalDownloads', 
            'thisWeekMovies'
        ));
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created movie in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'language' => 'nullable|string|max:50',
            'poster_url' => 'nullable|url',
            'download_link' => 'required|string',
            'file_size' => 'nullable|string|max:50',
            'quality' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        Movie::create($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully!');
    }

    /**
     * Display the specified movie.
     */
    public function show(Movie $movie)
    {
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified movie.
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified movie in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'language' => 'nullable|string|max:50',
            'poster_url' => 'nullable|url',
            'download_link' => 'required|string',
            'file_size' => 'nullable|string|max:50',
            'quality' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $movie->update($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified movie from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}

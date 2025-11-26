<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of movies.
     */
    public function index(Request $request)
    {
        $query = Movie::where('is_active', true);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('genre', 'like', "%{$searchTerm}%");
            });
        }

        // Genre filter
        if ($request->has('genre') && $request->genre) {
            $query->where('genre', $request->genre);
        }

        // Year filter
        if ($request->has('year') && $request->year) {
            $query->where('release_year', $request->year);
        }

        // Quality filter
        if ($request->has('quality') && $request->quality) {
            $query->where('quality', $request->quality);
        }

        // Language filter
        if ($request->has('language') && $request->language) {
            $query->where('language', $request->language);
        }

        $movies = $query->latest()->paginate(12);
        
        // Get filter options
        $genres = Movie::where('is_active', true)->distinct()->pluck('genre')->filter()->sort();
        $years = Movie::where('is_active', true)->distinct()->pluck('release_year')->filter()->sort()->reverse();
        $qualities = Movie::where('is_active', true)->distinct()->pluck('quality')->filter()->sort();
        $languages = Movie::where('is_active', true)->distinct()->pluck('language')->filter()->sort();

        return view('movies.index', compact('movies', 'genres', 'years', 'qualities', 'languages'));
    }

    /**
     * Display the specified movie.
     */
    public function show(Movie $movie)
    {
        if (!$movie->is_active) {
            abort(404);
        }

        // Get similar movies
        $similarMovies = Movie::where('is_active', true)
            ->where('id', '!=', $movie->id)
            ->where(function($query) use ($movie) {
                $query->where('genre', $movie->genre)
                      ->orWhere('release_year', $movie->release_year);
            })
            ->limit(6)
            ->get();

        return view('movies.show', compact('movie', 'similarMovies'));
    }

    /**
     * Handle movie download
     */
    public function download(Movie $movie)
    {
        if (!$movie->is_active || !$movie->download_link) {
            abort(404);
        }

        // Increment download count
        $movie->increment('downloads');

        // If it's a local file, serve it for download
        if (filter_var($movie->download_link, FILTER_VALIDATE_URL) === FALSE) {
            $filePath = storage_path('app/public/movies/' . $movie->download_link);
            if (file_exists($filePath)) {
                return response()->download($filePath, $movie->title . '.mp4');
            }
        }

        // If it's an external URL, redirect to it
        return redirect($movie->download_link);
    }

    /**
     * API endpoint for movies
     */
    public function api(Request $request)
    {
        $query = Movie::where('is_active', true);

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('genre', 'like', "%{$searchTerm}%");
            });
        }

        $movies = $query->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $movies->items(),
            'pagination' => [
                'current_page' => $movies->currentPage(),
                'last_page' => $movies->lastPage(),
                'per_page' => $movies->perPage(),
                'total' => $movies->total(),
            ]
        ]);
    }
}

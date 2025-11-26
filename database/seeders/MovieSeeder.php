<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'The Dark Knight',
                'description' => 'Batman raises the stakes in his war on crime. With the help of Lt. Jim Gordon and District Attorney Harvey Dent, Batman sets out to dismantle the remaining criminal organizations that plague the streets.',
                'genre' => 'Action',
                'release_year' => 2008,
                'language' => 'English',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
                'download_link' => 'https://example.com/download/dark-knight.mp4',
                'file_size' => '1.5 GB',
                'quality' => '1080p',
                'is_active' => true,
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'genre' => 'Sci-Fi',
                'release_year' => 2010,
                'language' => 'English',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
                'download_link' => 'https://example.com/download/inception.mp4',
                'file_size' => '1.8 GB',
                'quality' => '1080p',
                'is_active' => true,
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'genre' => 'Drama',
                'release_year' => 1994,
                'language' => 'English',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg',
                'download_link' => 'https://example.com/download/shawshank.mp4',
                'file_size' => '1.2 GB',
                'quality' => '720p',
                'is_active' => true,
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'genre' => 'Crime',
                'release_year' => 1994,
                'language' => 'English',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg',
                'download_link' => 'https://example.com/download/pulp-fiction.mp4',
                'file_size' => '1.4 GB',
                'quality' => '1080p',
                'is_active' => true,
            ],
            [
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'genre' => 'Crime',
                'release_year' => 1972,
                'language' => 'English',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg',
                'download_link' => 'https://example.com/download/godfather.mp4',
                'file_size' => '1.3 GB',
                'quality' => '720p',
                'is_active' => true,
            ],
        ];

        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}

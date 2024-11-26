<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchArticles extends Command
{
    protected $signature = 'fetch:articles';
    protected $description = 'Fetch articles from external news APIs and update the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Fetching articles from external APIs...');

        // Fetch articles from NewsAPI
        $newsApiResponse = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => env('NEWS_API_KEY'),
            'sources' => 'bbc-news',
        ]);
        //dd($newsApiResponse);

        // Fetch articles from The Guardian
        $guardianResponse = Http::get('https://content.guardianapis.com/search', [
            'api-key' => env('GUARDIAN_API_KEY'),
        ]);

        // Fetch articles from BBC News
        $bbcResponse = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => env('NEWS_API_KEY'),
            'sources' => 'bbc-news',
        ]);

        // Update Articles from NewsAPI
        $this->storeArticles($newsApiResponse->json()['articles'], 'NewsAPI');

        // Update Articles from The Guardian
        $this->storeArticles($guardianResponse->json()['response']['results'], 'The Guardian');

        // Update Articles from BBC News
        $this->storeArticles($bbcResponse->json()['articles'], 'BBC News');

        $this->info('Articles fetched and stored successfully!');
    }

    // Helper method to store articles in the database
    private function storeArticles(array $articles, string $source)
    {
        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title'] ?? $article['webTitle']],
                [
                    'content' => $article['description'] ?? $article['webDescription'] ?? '',
                    'author' => $article['author'] ?? 'Unknown',
                    'published_at' => $article['publishedAt'] ?? $article['webPublicationDate'],
                    'category' => $article['category'] ?? 'General',
                    'source' => $source,
                ]
            );
        }
    }
}

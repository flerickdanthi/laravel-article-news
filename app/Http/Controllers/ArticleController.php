<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ArticleController extends Controller
{
    // Fetch paginated articles with search filters
    public function index(Request $request)
    {
        $query = Article::query();

        // Filtering based on query parameters
        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
        if ($request->has('date')) {
            $query->whereDate('published_at', $request->date);
        }
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('source')) {
            $query->where('source', $request->source);
        }

        return response()->json($query->paginate(10));
    }

    // Fetch a single article's details
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return response()->json($article);
    }


public function fetchFromExternalAPI()
{
    // NewsAPI
    $newsApiResponse = Http::get('https://newsapi.org/v2/top-headlines', [
        'apiKey' => '664d6718c2b438e8a57ebf0ac25f76a',
        'sources' => 'bbc-news',
    ]);

    // The Guardian
    $guardianResponse = Http::get('https://content.guardianapis.com/search', [
        'api-key' => '1109d3b1-608b-4377-883a-da1475cc96e3',
    ]);

    // BBC News
    $bbcResponse = Http::get('https://newsapi.org/v2/top-headlines', [
        'apiKey' => '664d6718c2b438e8a57ebf0ac25f76a',
        'sources' => 'bbc-news',
    ]);

    // Handle NewsAPI articles
    if ($newsApiResponse->successful() && isset($newsApiResponse->json()['articles'])) {
        $newsApiArticles = $newsApiResponse->json()['articles'];
        foreach ($newsApiArticles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                [
                    'content' => $article['content'],
                    'author' => $article['author'] ?? 'Unknown',
                    'published_at' => $article['publishedAt'],
                    'category' => $article['category'] ?? 'General',
                    'source' => 'NewsAPI',
                ]
            );
        }
    }

    // Handle The Guardian articles
    if ($guardianResponse->successful() && isset($guardianResponse->json()['response']['results'])) {
        $guardianArticles = $guardianResponse->json()['response']['results'];
        foreach ($guardianArticles as $article) {
            Article::updateOrCreate(
                ['title' => $article['webTitle']],
                [
                    'content' => $article['webDescription'] ?? '',
                    'author' => $article['byline'] ?? 'Guardian',
                    'published_at' => $article['webPublicationDate'],
                    'category' => 'General',
                    'source' => 'The Guardian',
                ]
            );
        }
    }

    // Handle BBC News articles
    if ($bbcResponse->successful() && isset($bbcResponse->json()['articles'])) {
        $bbcArticles = $bbcResponse->json()['articles'];
        foreach ($bbcArticles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                [
                    'content' => $article['description'] ?? '',
                    'author' => $article['author'] ?? 'BBC',
                    'published_at' => $article['publishedAt'],
                    'category' => 'General',
                    'source' => 'BBC News',
                ]
            );
        }
    }

    return response()->json(['message' => 'Articles fetched successfully']);
}

public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'source' => 'required|string',
            'published_at' => 'required|date',
        ]);

        // Create the article
        $article = Article::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category' => $request->input('category'),
            'source' => $request->input('source'),
            'published_at' => $request->input('published_at'),
        ]);

        return response()->json($article, 201);  // Return the created article
    }
}


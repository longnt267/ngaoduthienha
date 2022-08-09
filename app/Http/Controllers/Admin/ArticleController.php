<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index() 
    {
        $about_us = $this->article->getByType('about us');
        $term = $this->article->getByType('term');
        $privacy_policy = $this->article->getByType('privacy policy');
        $guest_policy = $this->article->getByType('guest policy');
        return view('admin.article.index', compact('term', 'privacy_policy', 'guest_policy', 'about_us'));
    }

    public function saveData(Request $request) 
    {
        try {
            $this->article->saveData($request);
            return redirect()->route('article.index')->with('message', 'Update article successfully');          
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->with('error', 'Update article failed');
        }
    }
}

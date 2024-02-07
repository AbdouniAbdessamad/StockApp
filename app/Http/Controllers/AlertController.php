<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class AlertController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('alert.index', compact('articles'));
    }
}

    


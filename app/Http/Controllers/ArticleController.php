<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\Article;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::get();
        return view('articles.index',[
            'articles'=>$articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category=Category::select('id','name')->get();
        $suppliers = Supplier::select('id', 'name')->get();
        return view('articles.create', ['suppliers' => $suppliers],['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'bon_commande' => 'required|max:225|min:1',
            'supplier_id' => 'required|max:225|min:4',
            'ref' => 'required|max:225|min:1',
            'name' => 'required|max:225|min:1',
            'quantity' => 'required|numeric|min:0',
            'category_id' => '', // Assuming this is optional
            'status' => '', // Assuming this is optional
        ]);

        $article = new Article;
        $article->date = $request->date;
        $article->bon_commande = $request->bon_commande;
        $article->supplier_id = $request->supplier_id;
        $article->ref = $request->ref;
        $article->name = $request->name;
        $article->quantity = $request->quantity;
        $article->category_id = $request->category_id;
        $article->status = $request->status;
        $article->last_editor = Auth::id();
        $article->save();

        return redirect()->route('articles.show', ['article' => $article->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show',['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            "date" => "required|date",
            "bon_commande" => "required|max:225|min:1",
            "supplier_id" => "required|max:225|min:4",
            "ref" => "required|max:225|min:1",
            "name" => "required|max:225|min:1",
            "quantity" => "required|numeric|min:0",
            "category_id" => "",
            "status" => "",
        ]);

        // Add the last_editor_id when updating the article
        $data['last_editor'] = Auth::id();

        $article->update($data);

        return Redirect::route('articles.edit', ["article" => $article->id])->with('status', 'article-updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route("articles.index");
    }
}

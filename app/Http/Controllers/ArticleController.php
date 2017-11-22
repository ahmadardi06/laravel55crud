<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    //

	public function index() {
        $articles = Article::latest()->paginate(3);
        return view('articles.index',compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 3);

    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) 
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);
        Article::create($request->all());
        return redirect()->route('articles.index')
                        ->with('success','Article created successfully');
    }

    public function show($id) {
        $article = Article::find($id);
        return view('articles.show',compact('article'));
    }

    public function edit($id) {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id) {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);
        Article::find($id)->update($request->all());
        return redirect()->route('articles.index')
                        ->with('success','Article updated successfully');
    }

    public function destroy($id) {
        Article::find($id)->delete();
        return redirect()->route('articles.index')
                        ->with('success','Article deleted successfully');
    }
}

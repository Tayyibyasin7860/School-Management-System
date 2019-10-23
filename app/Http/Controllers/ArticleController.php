<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function index($categories)
    {
        $categories = explode('/', $categories);
        $category = array_pop($categories);

        $category = auth()->user()->schoolAdmin->categories->where('slug',$category)->first();

        if(empty($category))

            abort(404);

        $articles = $category->articles()
            ->orderBy('date', 'Desc')
            ->paginate(5);
        $articles_count = $category->articles()
            ->orderBy('date', 'Desc')
            ->published()
            ->get()->count();

        return view('student.article.category', compact('category','articles','articles_count'));

    }

//    public function paginate($categories, Request $request)
//    {
//        $categories = explode('/', $categories);
//        $category = array_pop($categories);
//
//        $category = Category::where('slug', $category)->first();
//        if(empty($category))
//            abort(404);
//
//        $skip = ($request->page * 4) - 4;
//        $articles = $category->articles()
//            ->orderBy('date', 'Desc')
//            ->published()
//            ->skip($skip)
//            ->take(4)
//            ->get();
//        $articles_count = $category->articles()
//            ->orderBy('date', 'Desc')
//            ->published()
//            ->get()->count();
//
//        return view('student.article._category', compact('articles','articles_count'));
//
//    }


    /**
     * Display the specified resource.
     *
     * @param  string  $categories
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($categories, $slug)
    {
        $categories = explode('/', $categories);
        $category = array_pop($categories);

        $category = Category::where('slug', $category)->first();
        if(empty($category))
            abort(404);

        $category = $category->name;

        $article = Article::where('slug', $slug)
            ->whereHas('category', function ($query) use ($category) {
//                $query->where('slug', $category);
            })
            ->published()
            ->first();

        if(empty($article))
            abort(404);

        return view('student.article.single', compact('article', 'category'));

    }

}

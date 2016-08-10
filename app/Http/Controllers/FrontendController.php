<?php

namespace App\Http\Controllers;


use App\Category;
use App\Post;
use App\Http\Requests;

class FrontendController extends Controller
{

    public function index()
    {
        $page = 'index';    

        return view('frontend.index', compact('page'));
    }
  

    public function category($value)
    {
        $category = Category::where('slug', $value)->first();

        if ($category->subCategories->count() == 0) {
            //child categories
            $posts = Post::publish()
                ->where('category_id', $category->id)
                ->latest('updated_at')
                ->limit(5)->get();
            $page = ($category->parent_id) ? $category->parent->slug : $category->slug;

        } else {
            //parent categories
            $page = $category->slug;
            $posts = Post::publish()
                ->whereIn('category_id', $category->subCategories->lists('id')->all())
                ->latest('updated_at')
                ->limit(5)->get();

        }

        return view('frontend.category', compact(
            'category', 'posts', 'page'
        ));
    }

    public function main($value)
    {
        if (preg_match('/([a-z0-9\-]+)\.html/', $value, $matches)) {
            $post = Post::where('slug', $matches[1])->get();
            if ($post->count() > 0) {
                $post = $post->first();
                $post->update(['views' => (int) $post->views + 1]);
                $page = $post->category->slug;
                return view('frontend.post', compact('post', 'page'));
            }

        }
    }
}

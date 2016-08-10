<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class PostsController extends AdminController
{
    public $categories;

    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $categoryIds = [];
        $categories = Category::all();
        foreach ($categories as $cate) {
            if ($cate->subCategories->count() == 0) {
                $categoryIds[] = $cate->id;
            }
        }
        $this->categories = array('' => 'Choose category') +  Category::whereIn('id', $categoryIds)->lists('name', 'id')->all();
    }


    public function index(Request $request)
    {

        $searchPost = '';
        $categoryId = '';
        $posts = Post::whereNull('user_id')->latest('updated_at');
        if ($request->input('q')) {
            $searchPost = urldecode($request->input('q'));
            $posts = $posts->where('title', 'LIKE', '%'. $searchPost. '%');
        }

        if ($request->input('cat')) {
            $categoryId = $request->input('cat');
            $category = Category::find($categoryId);
            $posts = ($category->subCategories->count() == 0) ? $posts->where('category_id', '=', $categoryId) : $posts->whereIn('category_id', $category->subCategories->lists('id')->all());
        }

        $posts = $posts->paginate(env('ITEM_PER_PAGE'));

        return view('admin.post.index', compact('posts', 'searchPost', 'categoryId'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('admin.post.form', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['image'] =  ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '';
        $data['status'] = ($request->input('status') == 'on') ? true : false;
        if (!$data['event_start']) {
            $data['event_start'] = null;
        }
        if (!$data['event_end']) {
            $data['event_end'] = null;
        }
        Post::create($data);
        flash('Create post success!', 'success');
        return redirect('admin/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = $this->categories;
        return view('admin.post.form', compact('post', 'categories'));
    }

    public function update($id, PostRequest $request)
    {
        $data = $request->all();
        $post = Post::find($id);
        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'), $post->image);
        }
        if (!$data['event_start']) {
            $data['event_start'] = null;
        }
        if (!$data['event_end']) {
            $data['event_end'] = null;
        }
        $data['status'] = ($request->input('status') == 'on') ? true : false;
        $post->update($data);
        flash('Update post success!', 'success');
        return redirect('admin/posts');
    }

    public function destroy($id)
    {
       $post = Post::find($id);
        if (file_exists(public_path('files/' . $post->image))) {
            @unlink(public_path('files/' . $post->image));
        }
        $post->delete();
        flash('Success deleted post!');
        return redirect('admin/posts');
    }

}

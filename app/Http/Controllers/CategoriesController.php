<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;

use App\Http\Requests\CategoryRequest;
use App\Post;


class CategoriesController extends AdminController
{
    public $parents;
    public $types;

    public function __construct()
    {
        parent::__construct();
        $this->parents = array('' => 'Choose parent category') + Category::whereNull('parent_id')->lists('name', 'id')->all();
    }

    public function index()
    {
        $categories = Category::latest()->paginate(env('ITEM_PER_PAGE'));
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->parents;
        return view('admin.category.form', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'parent_id' => ($request->input('parent_id') == 0) ? null : $request->input('parent_id'),
            'image' =>  ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '',
            'index_desc' => $request->input('index_desc'),
        ]);

        flash('Create category success!', 'success');
        return redirect('admin/categories');
    }


    /**
     * display form for edit category
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $parents = $this->parents;
        unset($parents[$id]);
        $category = Category::find($id);
        return view('admin.category.form', compact('parents', 'category'));
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CategoryRequest $request)
    {
        $category = Category::find($id);

        $data = [
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'parent_id' => ($request->input('parent_id') == 0) ? null : $request->input('parent_id'),
            'index_desc' => $request->input('index_desc'),
        ];

        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'), $category->image);
        }

        $category->update($data);

        flash('Update category success!', 'success');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        Post::where('category_id', $category->id)->delete();
        $category->delete();

        flash('Success deleted category!');
        return redirect('admin/categories');
    }



}

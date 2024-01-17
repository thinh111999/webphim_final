<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $list = Category::orderBy('position','ASC')->get();
        return view('admincp.category.index', compact('list'));
    }

    public function create()
    {
        return view('admincp.category.form');
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $request->validate(
            [
                'title'=>'required|unique:categories|max:255',
                'slug'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
                'position'=>'required|unique:categories|max:20',
            ],[
                'title.unique'=>'Tên danh mục này đã có, vui lòng điền tên khác',
                'slug.unique'=>'Slug danh mục này đã có, vui lòng điền slug khác',
                'position.unique'=>'Vị trí này đã có, vui lòng chọn vị trí khác',
                'title.required'=>'Vui lòng điền tên danh mục',
                'slug.required'=>'Vui lòng điền tên slug',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
                'position.required'=>'Vui lòng điền vị trí',
            ]
        );
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->position = $data['position'];
        $category->save();
        toastr()->success('Congrats', 'Thêm danh mục phim thành công!');
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $category = Category::find($id);
        $list = Category::orderBy('position','ASC')->get();
        return view('admincp.category.form', compact('list','category'));
    }


    public function update(Request $request, $id)
    {
        // $data = $request->all();
        $data = $request->validate(
            [
                'title'=>'required|unique:categories|max:255',
                'slug'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
                'position'=>'required|unique:categories|max:20',
            ],[
                'title.unique'=>'Tên danh mục này đã có, vui lòng điền tên khác',
                'slug.unique'=>'Slug danh mục này đã có, vui lòng điền slug khác',
                'position.unique'=>'Vị trí này đã có, vui lòng chọn vị trí khác',
                'title.required'=>'Vui lòng điền tên danh mục',
                'slug.required'=>'Vui lòng điền tên slug',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
                'position.required'=>'Vui lòng điền vị trí',
            ]
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->position = $data['position'];
        $category->save();
        toastr()->success('Congrats', 'Sửa danh mục phim thành công!');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    public function resorting(Request  $request){
        $data = $request->all();

        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}

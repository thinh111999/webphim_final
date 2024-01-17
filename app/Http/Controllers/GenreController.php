<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{

    public function index()
    {
        $list = Genre::all();
        return view('admincp.genre.index', compact('list'));
    }

    public function create()
    {
        return view('admincp.genre.form');
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
                'title.required'=>'Vui lòng điền tên danh mục',
                'slug.required'=>'Vui lòng điền tên slug',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
            ]
        );
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        toastr()->success('Congrats', 'Thêm thể loại phim thành công!');
        return redirect()->route('genre.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.form', compact('list','genre'));
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
            ],[
                'title.unique'=>'Tên danh mục này đã có, vui lòng điền tên khác',
                'slug.unique'=>'Slug danh mục này đã có, vui lòng điền slug khác',
                'title.required'=>'Vui lòng điền tên danh mục',
                'slug.required'=>'Vui lòng điền tên slug',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
            ]
        );
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        toastr()->success('Congrats', 'Sửa thể loại phim thành công!');
        return redirect()->route('genre.index');
    }

    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back();
    }
}

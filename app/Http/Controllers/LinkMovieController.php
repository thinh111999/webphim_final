<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkMovie;
class LinkMovieController extends Controller
{
    public function index()
    {
        $list = LinkMovie::orderBy('id', 'ASC')->get();
        return view('admincp.linkmovie.index', compact('list'));
    }

    public function create()
    {
        return view('admincp.linkmovie.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],[
                'title.unique'=>'Tên danh mục này đã có, vui lòng điền tên khác',
                'title.required'=>'Vui lòng điền tên danh mục',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
            ]
        );
        $linkmovie = new LinkMovie();
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
        toastr()->success('Congrats', 'Thêm Link phim thành công!');
        return redirect()->route('linkmovie.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $linkmovie = LinkMovie::find($id);
   
        return view('admincp.linkmovie.form', compact('linkmovie'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title'=>'required|unique:linkmovie|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],[
                'title.unique'=>'Tên link này đã có, vui lòng điền tên khác',
                'title.required'=>'Vui lòng điền tên link',
                'description.required'=>'Vui lòng điền mô tả link',
                'status.required'=>'Vui lòng chọn trạng thái',
            ]
        );
        $linkmovie = LinkMovie::find($id);
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
        toastr()->success('Congrats', 'Cập nhật Link phim thành công!');
        return redirect()->route('linkmovie.index');
    }

    public function destroy(string $id)
    {
        LinkMovie::find($id)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
class CountryController extends Controller
{

    public function index()
    {
        $list = Country::all();
        return view('admincp.country.index', compact('list'));
    }


    public function create()
    {
        return view('admincp.country.form');
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
            ],[
                'title.unique'=>'Tên danh mục này đã có, vui lòng điền tên khác',
                'slug.unique'=>'Slug danh mục này đã có, vui lòng điền slug khác',
                'title.required'=>'Vui lòng điền tên danh mục',
                'slug.required'=>'Vui lòng điền tên slug',
                'description.required'=>'Vui lòng điền mo tả phim',
                'status.required'=>'Vui lòng chọn trạng thái',
            ]
        );
        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        toastr()->success('Congrats', 'Thêm quốc gia phim thành công!');
        return redirect()->route('country.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $country = Country::find($id);
        $list = Country::all();
        return view('admincp.country.form', compact('list','country'));
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
        $country = Country::find($id);
        $country->title = $data['title'];
        $country->slug = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        toastr()->success('Congrats', 'Sửa quốc gia phim thành công!');
        return redirect()->route('country.index');
    }

 
    public function destroy($id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}

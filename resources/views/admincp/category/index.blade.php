@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
      <table class="table" id="tablephim">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Đường dẫn</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Vị Trí</th>
            
          </tr>
        </thead>
        <tbody class="order_position">
          @foreach($list as $key => $cate)
          <tr id="{{$cate->id}}">
            <th scope="row">{{$key}}</th>
            <td>{{$cate->title}}</td>
            <td>{{$cate->description}}</td>
            <td>{{$cate->slug}}</td>
            <td>
              @if($cate->status)
                  Hiển thị
              @else   
                  Không hiển thị                           
              @endif
            </td>
            <td>{{$cate->position}}</td>
            <td>
                {!! Form::open(['method'=>'DELETE','route'=>['category.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                  {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
                <br>
                <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category">
  Thêm nhanh
</button>

<!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    {!! Form::open(['route'=>'category.store','method'=>'POST']) !!}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quản lý danh mục phim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          {{-- <div class="card-header"></div> --}}
          {{-- alert --}}

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif
              
                  <div class="form-group">
                      {!! Form::label('title', 'Tên danh mục', []) !!}
                      {!! Form::text('title', isset($category) ? $category->title : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()', 'required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('slug', 'Đường dẫn', []) !!}
                      {!! Form::text('slug', isset($category) ? $category->slug : '', ['class'=>'form-control','placeholder'=>'...','id'=>'convert_slug','required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('description', 'Mô tả danh mục', []) !!}
                      {!! Form::textarea('description', isset($category) ? $category->description : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description', 'required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('status', 'Trạng thái', []) !!}
                      {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($category) ? $category->status : '', ['class'=>'form-control', 'required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('position', 'Vị trí danh mục', []) !!}
                      {!! Form::text('position', isset($category) ? $category->position : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()', 'required'=>'required']) !!}
                  </div>
                  {{-- @if(!isset($category))
                      {!! Form::submit('Thêm Danh Mục', ['class'=>'btn btn-success']) !!}
                  @else
                      {!! Form::submit('Cập Nhật Danh Mục', ['class'=>'btn btn-success']) !!}
                  @endif --}}
             
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::submit('Thêm Danh Mục', ['class'=>'btn btn-primary']) !!}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection

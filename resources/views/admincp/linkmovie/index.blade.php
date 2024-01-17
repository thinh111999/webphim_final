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
            <th scope="col">Trạng thái</th>     
          </tr>
        </thead>
        <tbody class="order_position">
          @foreach($list as $key => $link)
          <tr id="{{$link->id}}">
            <th scope="row">{{$key}}</th>
            <td>{{$link->title}}</td>
            <td>{{$link->description}}</td>
            <td>
              @if($link->status)
                  Hiển thị
              @else   
                  Không hiển thị                           
              @endif
            </td>
            <td>
                {!! Form::open(['method'=>'DELETE','route'=>['linkmovie.destroy',$link->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                  {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
                <br>
                <a href="{{route('linkmovie.edit',$link->id)}}" class="btn btn-warning">Sửa</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#linkmovie">
  Thêm nhanh
</button>

<!-- Modal -->
<div class="modal fade" id="linkmovie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    {!! Form::open(['route'=>'linkmovie.store','method'=>'POST']) !!}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quản lý link</h5>
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
                      {!! Form::label('title', 'Tên link', []) !!}
                      {!! Form::text('title', isset($linkgory) ? $linkgory->title : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()', 'required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('description', 'Mô tả link', []) !!}
                      {!! Form::textarea('description', isset($linkgory) ? $linkgory->description : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description', 'required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('status', 'Trạng thái', []) !!}
                      {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($linkgory) ? $linkgory->status : '', ['class'=>'form-control', 'required'=>'required']) !!}
                  </div>
                  {{-- @if(!isset($linkgory))
                      {!! Form::submit('Thêm Danh Mục', ['class'=>'btn btn-success']) !!}
                  @else
                      {!! Form::submit('Cập Nhật Danh Mục', ['class'=>'btn btn-success']) !!}
                  @endif --}}
             
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::submit('Thêm link', ['class'=>'btn btn-primary']) !!}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection

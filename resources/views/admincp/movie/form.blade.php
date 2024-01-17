@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              {{-- <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt Kê Danh Sách Phim</a>
                <div class="card-header">Quản Lý Phim</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($movie))
                        {!! Form::open(['route'=>'movie.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movie.update',$movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                    {{-- title --}}
                        <div class="form-group">
                            {!! Form::label('title', 'Tên phim', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                    {{-- episode --}}
                        <div class="form-group">
                            {!! Form::label('sotap', 'Số tập phim', []) !!}
                            {!! Form::text('sotap', isset($movie) ? $movie->sotap : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                    {{-- Time to watch --}}
                        <div class="form-group">
                            {!! Form::label('thoiluong', 'Thời lượng phim', []) !!}
                            {!! Form::text('thoiluong', isset($movie) ? $movie->thoiluong : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                    {{-- english name --}}
                        <div class="form-group">
                            {!! Form::label('Tên tiếng anh', 'Tên tiếng anh', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                    {{-- trailer --}}
                        <div class="form-group">
                            {!! Form::label('trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                    {{-- link url --}}
                        <div class="form-group">
                            {!! Form::label('slug', 'Đường dẫn', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder'=>'...','id'=>'convert_slug']) !!}
                        </div>
                    {{-- description --}}
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả phim', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description']) !!}
                        </div>
                    {{-- tags --}}
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags phim', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...']) !!}
                        </div>
                    {{-- status --}}
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- sub --}}
                        <div class="form-group">
                            {!! Form::label('phude', 'Phụ đề', []) !!}
                            {!! Form::select('phude', ['0'=>'Vietsub','1'=>'Thuyết minh'], isset($movie) ? $movie->phude : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- quality --}}
                        <div class="form-group">
                            {!! Form::label('resolution', 'Định dạng', []) !!}
                            {!! Form::select('resolution', ['0'=>'SD','1'=>'HD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- category --}}
                        <div class="form-group">
                            {!! Form::label('Category', 'Danh mục', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- thuộc phim bô hoặc lẻ --}}
                        <div class="form-group">
                            {!! Form::label('thuocphim', 'Thuộc loại phim (Bộ hay Lẻ)', []) !!}
                            {!! Form::select('thuocphim', ['0'=>'Phim Lẻ','1'=>'Phim Bộ'], isset($movie) ? $movie->thuocphim : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- country --}}
                        <div class="form-group">
                            {!! Form::label('Country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- genre --}}
                        <div class="form-group">
                            {!! Form::label('Genre', 'Thể loại', []) !!} <br>
                            
                                @foreach($list_genre as $key => $gen)
                                    @if(isset($movie)) <!-- Kiểm tra xem biến $movie đã được khai báo hay chưa -->
                                        {!! Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                                        
                                    @else
                                        {!! Form::checkbox('genre[]', $gen->id,'') !!}
                                        
                                    @endif
                                    {!! Form::label('genre', $gen->title) !!} <br>
                                @endforeach                           
                            
                        </div>
                    
                    {{-- hot movie --}}
                        <div class="form-group">
                            {!! Form::label('Hot', 'Phim hot', []) !!}
                            {!! Form::select('phim_hot', ['1'=>'Có','0'=>'Không'], isset($movie) ? $movie->phim_hot : '', ['class'=>'form-control']) !!}
                        </div>
                    {{-- image --}}
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình ảnh', []) !!}
                            {!! Form::file('image', ['class'=>'form-control-file']) !!}
                            @if(isset($movie))
                              <img width="150" src="{{asset('uploads/movie/'.$movie->image)}}">
                            @endif
                        </div>
                        @if(!isset($movie))
                            {!! Form::submit('Thêm Phim', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập Nhật Phim', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

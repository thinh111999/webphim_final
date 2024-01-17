@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('episode.create')}}" class="btn btn-primary">Thêm Tập Phim</a>
                <table class="table table-responsive" id="tablephim">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Hình ảnh phim</th>
                        <th scope="col">Tập phim</th>
                        <th scope="col">Link phim</th>
                        {{-- <th scope="col">Trạng thái</th> --}}
                        <th scope="col">Quản lý</th>
                    </tr>
                    </thead>
                    
                    <tbody>  {{-- class="order_position" --}}
                    @foreach($list_episode as $key => $episode)

                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$episode->movie->title}}</td>
                        <td><img width="100" src="{{asset('uploads/movie/'.$episode->movie->image)}}"></td>
                        <td><span class="badge badge-success" style="font-size: 20px" >{{$episode->episode}}</span></td>
                        <td style="width: 20%">{{$episode->linkphim}}</td>
                        {{-- <td style="width: 20%">{!!$episode->linkphim!!}</td> --cách ghi này nhằm để chạy mã html trong csdl --}}
                        {{-- <td>
                        @if($episode->status)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                        </td> --}}
                        <td>
                            {!! Form::open(['method'=>'DELETE','route'=>['episode.destroy',$episode->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <br>
                            <a href="{{route('episode.edit',$episode->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
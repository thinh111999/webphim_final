@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">Trang Quản Lý</div> --}}
                <br>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <span class="badge bg-danger" style="
                        font-size:                   20px;
                        font-weight:                 font-weight-bold;
                        color:                       white;
                        padding-y:                   35em;
                        padding-x:                   65em;
                        border-radius:               100px 10px;">
                        Welcome Admin <i>Tank_Fuck_Think -- (FUCKING_TANK)</i> is Back !!!
                    </span>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

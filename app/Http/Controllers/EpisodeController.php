<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\LinkMovie;
use Carbon\Carbon;
class EpisodeController extends Controller
{

    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id','DESC')->get();
        // return response()->json($list_episode);
        return view('admincp.episode.index',compact('list_episode'));
    }


    public function create()
    {
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // $episode_check = Episode::where('episode',$data['episode'])->where('movie_id', $data['movie_id'])->count();
        // if($episode_check > 0){
        //     return redirect()->back();
        // }else{
            $ep = new Episode();
            $ep->movie_id = $data['movie_id'];
            $ep->linkphim = $data['link'];
            $ep->server = $data['linkserver'];
            $ep->episode = $data['episode'];
            $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ep->save();
        // }
        return redirect()->back();
    }

    public function add_episode($id){
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $list_server = LinkMovie::orderBy('id', 'DESC')->get();
        $movie = Movie::find($id);
        $list_episode = Episode::with('movie')->where('movie_id',$id)->orderBy('episode','DESC')->get();
        // return response()->json($list_episode);
        return view('admincp.episode.add_episode',compact('list_episode', 'movie', 'linkmovie', 'list_server'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        $episode = Episode::find($id);
        return view('admincp.episode.form',compact('episode','list_movie', 'linkmovie'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $ep = Episode::find($id);
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['link'];
        $ep->server = $data['linkserver'];
        $ep->episode = $data['episode'];
        $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        return redirect()->to('add-episode/'.$ep->movie_id);
    }

    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->route('episode.index');
    }

    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output='<option>---Chọn tập phim---</option>';
        if($movie->thuocphim=='phimbo'){
            for($i=1; $i<=$movie->sotap; $i++){
                $output.='<option value="'.$i.'">'.$i.'</option>';
            }
        }else{
            $output.='<option value="HD"> HD </option> 
            <option value="FullHD"> FullHD </option>
            <option value="Cam"> Cam </option>
            <option value="HDCam"> HDCam </option>';
        }
        echo $output;
    }
}

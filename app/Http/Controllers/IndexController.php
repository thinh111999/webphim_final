<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Episode;
use App\Models\Rating;
use App\Models\LinkMovie;
use App\Models\Info;
use DB;

class IndexController extends Controller
{
    // lọc phim
    public function locphim(){
        
        //get
        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];
        if($sapxep=='' && $genre_get=='' && $country_get=='' && $year_get==''){
            return redirect()->back();
        }else{

            //lấy dữ liệu
            $movie = Movie::withCount('episode');
            if($genre_get){
                $movie = $movie->where('genre_id', '=', $genre_get);
            }elseif($country_get){
                $movie = $movie->where('country_id', '=', $country_get);
            }elseif($year_get){
                $movie = $movie->where('year', '=', $year_get);
            }elseif($sapxep){
                $movie = $movie->orderBy('title', 'ASC');
            }

            $movie = $movie->orderBy('ngaycapnhat','DESC')->paginate(40);
            return view('pages.locphim', compact('movie'));
        }
    }

    // tìm kiếm
    public function timkiem(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $movie = Movie::withCount('episode')->where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
    
            // Di chuyển phần gán giá trị cho biến meta sau khi có kết quả từ tìm kiếm
            $meta_title = "Kết quả tìm kiếm cho: " . $search;
            $meta_description = "Danh sách phim liên quan đến tìm kiếm: " . $search;
            $meta_image = url('uploads/movie/'.$movie->first()->image); // Lấy hình ảnh của phim đầu tiên trong kết quả
    
            return view('pages.timkiem', compact('search','movie','meta_title','meta_description','meta_image'));
        }else{
            return redirect()->to('/');
        }
    }
    

    // trang chủ
    public function home(){

        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description; 
        $meta_image = url('uploads/logo/netflix.png');
        $phimhot = Movie::withCount('episode')->where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category_home = Category::with(['movie'=> function($q){$q->withCount('episode')->where('status',1);} ])->orderBy('position','ASC')->where('status',1)->get();
    	return view('pages.home', compact('category_home','phimhot','meta_title','meta_description','meta_image'));
    }

    // danh mục
    public function category($slug){
        
        $cate_slug = Category::where('slug',$slug)->first();
        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description; 
        $meta_image = url('uploads/logo/netflix.png');
        $movie = Movie::withCount('episode')->where('category_id',$cate_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.category', compact('cate_slug','movie','meta_title','meta_description','meta_image'));
    }

    // năm
    public function year($year){
        
        $year = $year;
        $meta_title = 'Năm phim: '.$year;
        $meta_description = 'Tìm phim năm: '.$year;
        $meta_image = url('uploads/logo/netflix.png'); 
        $movie = Movie::withCount('episode')->where('year',$year)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.year', compact('year','movie','meta_title','meta_description','meta_image'));
    }

    // từ khóa tìm kiếm
    public function tag($tag){
       
        $tag = $tag;
        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = url('uploads/logo/netflix.png');
        $movie = Movie::withCount('episode')->where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.tag', compact('tag','movie','meta_title','meta_description','meta_image'));
    }

    // thể loại
    public function genre($slug){
        
        $genre_slug = Genre::where('slug',$slug)->first();
        $meta_title = $genre_slug->title;
        $meta_description = $genre_slug->description;
        $meta_image = url('uploads/logo/netflix.png');
        //nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }

        $movie = Movie::withCount('episode')->whereIn('id',$many_genre)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.genre', compact('genre_slug','movie','meta_title','meta_description','meta_image'));
    }

    // quốc gia
    public function country($slug){
        
        $country_slug = Country::where('slug',$slug)->first();
        $meta_title = $country_slug->title;
        $meta_description = $country_slug->description;
        $meta_image = url('uploads/logo/netflix.png');
        $movie = Movie::withCount('episode')->where('country_id',$country_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.country', compact('country_slug','movie','meta_title','meta_description','meta_image'));
    }

    // phim
    public function movie($slug){
       
        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->where('status',1)->first();

        $meta_title = $movie->title;
        $meta_description = $movie->description;
        
        $meta_image = url('uploads/movie/'.$movie->image);
        //lấy tập đầu
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode','ASC')->take(1)->first();
        //phim liên quan
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode','DESC')->take(3)->get();
        //lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        // rating movie
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating);

        $count_total = Rating::where('movie_id', $movie->id)->count();

        //increase movie views
        $count_views = $movie->count_views;
        $count_views += 1;
        $movie->count_views = $count_views;
        $movie->save();
    	return view('pages.movie', compact('movie','related','episode','episode_tapdau','episode_current_list_count','rating','count_total','meta_title','meta_description','meta_image'));
    }

    // Rating đánh giá
    public function add_rating(Request $request){
        $data = $request->all();
        $ip_address = $request->ip();

        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('ip_address', $ip_address)->count();
        if($rating_count>0){
            echo 'exist';
        }else{
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
    }
    // xem phim
    public function watch($slug, $tap, $server_active){
        
        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();
        $meta_title = 'Xem phim: '.$movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //lấy tập 1
        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)-> where('episode',$tapphim)->first();
        }else{

            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)-> where('episode',$tapphim)->first();
        }
        
        $server = LinkMovie::orderBy('id', 'DESC')->get();
        $episode_movie = Episode::where('movie_id', $movie->id)->orderBy('episode', 'ASC')->get()->unique('server');
        $episode_list = Episode::where('movie_id', $movie->id)->orderBy('episode', 'ASC')->orderBy('episode', 'ASC')->get();

    	return view('pages.watch', compact('movie','episode','tapphim','related','meta_title','meta_description','meta_image','server','episode_movie','episode_list','server_active'));
    }
    
    // tập phim
    public function episode(){
        
    	return view('pages.episode');
    }
}

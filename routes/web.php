<?php
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    use App\Note;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Redis;
    use App\Helper\RedisChecker as RedisChecker;
    Route::get('/', function(){
    
    
//        dd(app('cache'));
        
//        if(RedisChecker::check()){
//            return 1;
//        }
        
//        return 2;
//        return RedisCheck::check();
        
        /*
        $nts =  Cache::remember('notes', 60*60*24, function(){
            return Note::all();
        });
        
        Cache::forget('notes');
        
        return Cache::get('notes');
    */
    
        
    
    /*
        $articles = Cache::remember('note', 22*60, function() {
            return Note::all();
        });
        Redis::set('name', 'Taylor');
    */
        
//        dd(Redis::get('name'));
        /*
        $redis = Redis::connection();
        dd($redis);
        */
//        dd(Cache::pull('name', 'dkjash d'));

//        $expiresAt = Carbon::now()->addSecond(30);
//
//        Cache::put('anasayfacache', Note::all(), $expiresAt);
    /*
        $articles = Cache::remember('note', 22*60, function() {
            return Note::all();
        });
        return $articles;
        /* $cache = Redis::connection();
         $value = Cache::get('key');
         return $cache->ping();
         //    return view('welcome');
        */
    });

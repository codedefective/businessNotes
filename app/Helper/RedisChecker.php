<?php
    
    namespace App\Helper;
    
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Redis;
    
    class RedisChecker
    {
        public static function remembering($key, $data)
        {
            if(self::connectionCheck()){
                return Cache::rememberForever($key, function() use ($data){
                    return $data;
                });
            }
            return $data;
        }
        
        public static function connectionCheck($connection = 'default') : bool
        {
            try{
                Redis::connection($connection)
                     ->ping();
                return true;
            }
            catch(\Predis\Connection\ConnectionException $e){
                return false;
            }
        }
        
        public static function updateCache($key, $newData)
        {
            if(Cache::has($key)){
                $data = Cache::get($key);
                array_unshift($data, $newData);
                Cache::forever($key, $data);
            }
        }
        
        
    }
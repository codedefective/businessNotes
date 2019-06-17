<?php
    
    namespace App\Http\Controllers\api;
    
    use App\Http\Controllers\Controller;
    use App\Tag;

    class BaseApiController extends Controller
    {
        public function sendResponse($result)
        {
            return response()->json($result);
        }
        public function sendSuccess($msg){
            $response = [
                'success' => true,
                'message' => $msg,
            ];
            return response()->json($response);
        }
        public function sendError($error, $code = 404)
        {
            $response = [
                'success' => false,
                'message' => $error,
            ];
            
            return response()->json($response, $code);
        }
        protected function saveTags($tags) : array
        {
            $tag_id = [];
            if(is_array($tags) && count($tags) > 0){
                foreach($tags as $item){
                    $tag      = Tag::firstOrCreate(['name' => $item]);
                    $tag_id[] = $tag->id;
                }
            }
            return $tag_id;
        }
        
    }

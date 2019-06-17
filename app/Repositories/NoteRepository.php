<?php
    
    namespace App\Repositories;
    
    use App\Helper\RedisChecker;
    use App\Note;
    use App\Repositories\Interfaces\NoteInterface;
    use App\Tag;
    use Illuminate\Support\Facades\Cache;
    
    class NoteRepository implements NoteInterface
    {
        public function index()
        {
            $notes = RedisChecker::remembering('notes', $this->getNotes()
                                                             ->toArray());
            return response($notes);
        }
        
        public function getNotes()
        {
            return Note::with('tags')
                       ->get()
                       ->sortByDesc('id')
                       ->makeVisible('id')
                       ->values();
        }
        
        public function create()
        {
            // TODO: Implement create() method.
        }
        
        public function store($request)
        {
            $data           = $request->all();
            $tags           = $request->get('tags');
            $data['tag_id'] = $this->saveTags($tags);
            if($create = Note::create($data)){
                $returnNote = $this->noteCheckAndReturnResponse($create->id);
                RedisChecker::updateCache('notes', $this->noteCheck($create->id)
                                                        ->makeVisible('id')
                                                        ->toArray());
                return $returnNote;
            }
            return $this->sendError('Failed to Create Note');
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
        
        public function noteCheckAndReturnResponse($id)
        {
            $note = $this->noteCheck($id);
            return $note ? $this->sendResponse($note) : $this->sendError('No Such Note');
        }
        
        public function noteCheck($id)
        {
            $note = Note::where('id', $id)
                        ->with('tags')
                        ->first();
            return $note ? : false;
        }
        
        public function sendResponse($result)
        {
            return response()->json($result);
        }
        
        public function sendError($error, $code = 404)
        {
            $response = [
                'success' => false,
                'message' => $error,
            ];
            return response()->json($response, $code);
        }
        
        public function edit($id)
        {
            $note = $this->noteCheck($id);
            if($note){
                $returnNote = RedisChecker::remembering('note_' . $id, $note->toArray());
                return $this->sendResponse($returnNote);
            }
            return $this->sendError('No Such Note');
        }
        
        public function show($id)
        {
            $note = $this->noteCheck($id);
            if($note){
                $returnNote = RedisChecker::remembering('note_' . $id, $note->toArray());
                return $this->sendResponse($returnNote);
            }
            return $this->sendError('No Such Note');
        }
        
        public function update($request, $id)
        {
            $note = $this->noteCheck($id);
            if(!$note){
                return $this->sendError('No Such Note');
            }
            $data           = $request->all();
            $tags           = $request->get('tags');
            $data['tag_id'] = $this->saveTags($tags);
            $note->update($data);
            $this->cacheAllNotes();
            return $this->noteCheckAndReturnResponse($note->id);
        }
        
        public function cacheAllNotes()
        {
            Cache::forget('notes');
            return Cache::forever('notes', $this->getNotes()
                                                ->toArray());
        }
        
        public function destroy($id)
        {
            $note = $this->noteCheck($id);
            if(!$note){
                return $this->sendError('No Such Note');
            }
            if($note->delete()){
                Cache::forget('note_' . $id);
                $this->cacheAllNotes();
                return $this->sendSuccess('Note Deleted');
            }
            return $this->sendError('Failed to Delete Note');
        }
        
        public function sendSuccess($msg)
        {
            $response = [
                'success' => true,
                'message' => $msg,
            ];
            return response()->json($response);
        }
    }
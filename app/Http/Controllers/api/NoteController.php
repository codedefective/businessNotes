<?php
    
    namespace App\Http\Controllers\api;
    
    use App\Http\Requests\NoteStore;
    use App\Http\Requests\NoteUpdate;
    use App\Repositories\Interfaces\NoteInterface;
    
    class NoteController extends BaseApiController
    {
        protected $note = null;
        
        public function __construct(NoteInterface $note)
        {
            $this->note = $note;
        }
        
        public function index()
        {
            return $this->note->index();
        }
        
        public function create()
        {
        
        }
        
        public function store(NoteStore $request)
        {
            return $this->note->store($request);
        }
        
        public function show($id)
        {
            return $this->note->show($id);
        }
        
        public function edit($id)
        {
            return $this->note->edit($id);
        }
        
        public function update(NoteUpdate $request, $id)
        {
            return $this->note->update($request, $id);
        }
        
        public function destroy($id)
        {
            return $this->note->destroy($id);
        }
    }

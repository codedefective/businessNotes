<?php
    
    namespace App\Repositories\Interfaces;
    
    interface NoteInterface
    {
        public function index();
        
        public function create();
        
        public function store($request);
        
        public function show($request);
        
        public function edit($id);
        
        public function update($request, $id);
        
        public function destroy($id);
    }
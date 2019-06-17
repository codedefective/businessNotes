<?php
    
    namespace Tests\Unit;
    
    use Tests\TestCase;
    
    class NoteTest extends TestCase
    {
        /**
         * A basic unit test example.
         *
         * @return void
         */
        public function testCreateNote() : void
        {
            $data     = [
                'name'    => 'testnote',
                'content' => 'testContent',
            ];
            $response = $this->json('POST', '/note', $data);
            $response->assertStatus(200);
            //             $response->assertJson(['message' => 'message','errors'=> ['name'=> ['The name field is required.']]]);
        }
        
        public function testCreateNoteWithTags() : void
        {
            $data     = [
                'name'    => 'testnote',
                'content' => 'testContent',
                'tags' => [
                    'testtag 1', 'testtag 2'
                ]
            ];
            $response = $this->json('POST', '/note', $data);
            $response->assertStatus(200);
            //             $response->assertJson(['message' => 'message','errors'=> ['name'=> ['The name field is required.']]]);
        }
        
        public function testNameIsRequiredWhenAddingNotes() : void
        {
            $data     = [
                'name'    => '',
                'content' => 'notecontent',
            ];
            $response = $this->json('POST', '/note', $data);
            $response->assertStatus(422);
        }
        
        public function testUpdateNote() : void
        {
            $response = $this->json('GET', '/note');
            $response->assertStatus(200);
            $note   = $response->decodeResponseJson()[0];
            $data   = [
                'name'    => 'Changed for test',
                'content' => 'Changed for test',
            ];
            $update = $this->json('PUT', '/note/' . $note['id'], $data);
            $update->assertStatus(200);
        }
        
        public function testDeleteNote() : void
        {
            $response = $this->json('GET', '/note');
            $response->assertStatus(200);
            $note   = $response->decodeResponseJson()[0];
            $delete = $this->json('DELETE', '/note/' . $note['id']);
            $delete->assertStatus(200);
            $delete->assertJson(['success' => true]);
            $delete->assertJson(['message' => 'Note Deleted']);
        }
        
        public function testGetAllNote() : void
        {
            $response = $this->json('GET','/note');
            $response->assertStatus(200);
        }
    }

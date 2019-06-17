<?php
    
    namespace App;
    
    use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use Illuminate\Database\Eloquent\Model;
    
    
    class Note extends Model
    {
        
        use HasJsonRelationships;
        public    $hidden   = ['id', 'user_id', 'tag_id'];
        protected $fillable = ['name', 'content', 'tag_id'];
        protected $casts    = [
            'tag_id' => 'object'
        ];
    
        public function tags()
        {
            return $this->belongsToJson(Tag::class, 'tag_id');
        }
        
        
    }

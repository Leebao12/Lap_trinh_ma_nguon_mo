<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['id', 'title', 'body']; 
 
    public function resolveRouteBinding($value, $field = null) 
    { 
        $articles = session('articles', [ 
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'], 
            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'], 
        ]); 
 
        foreach ($articles as $a) { 
            if ($a['id'] == $value) { 
                $instance = new self($a); 
                $instance->id = $a['id']; 
                $instance->exists = true; 
                return $instance; 
            } 
        } 

        $instance = new self([ 
            'id' => (int)$value,  
            'title' => "Bài viết #" . (int)$value,  
            'body' => "Nội dung bài viết mẫu số " . (int)$value 
        ]); 
        $instance->id = (int)$value; 
        $instance->exists = true; 
        return $instance; 
    }
}

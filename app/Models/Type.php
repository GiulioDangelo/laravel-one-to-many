<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // hasMany si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a molti
    // hasOone si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a uno
    public function posts(){
        return $this->hasMany(Post::class);
    }
}

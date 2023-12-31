<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    
    // belongsTo si usa nel model della tabella che ha la chiave esterna, di conseguenza quella che sta dalla parte del molti
    public function type(){
        return $this->belongsTo(Type::class);
    }
}

<?php

// Alert.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'reference',
        'name',
    ];
    public function article()
    {
        return $this->belongsTo(Article::class, 'name', 'name');
    }
}


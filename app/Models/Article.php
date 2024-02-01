<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'bon_commande',
        'fournisseur_id',
        'ref',
        'name',
        'quantity',
        'category_id',
        'status',
        'last_editor_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function lastEditor()
    {
        return $this->belongsTo(User::class, 'last_editor_id', 'id');
    }

}

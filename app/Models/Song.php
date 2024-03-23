<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['l_p_id', 'slug', 'title'];

    public function lp(): BelongsTo
    {
        return $this->belongsTo(LP::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    public $asYouType = true;

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id, // <- Always include the primary key
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    protected $fillable = ['title','description','category_id'];

    protected $with = ['category'];

    public function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }
}

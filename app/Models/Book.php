<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'amount',
        'file',
        'cover'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: fn ($cover) => url('/storage/images/' . $cover),
        );
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($file) => url('/storage/files/' . $file),
        );
    }
}

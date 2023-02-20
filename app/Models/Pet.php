<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photoUrls',
        'status',
    ];

    protected $casts = [
        'photoUrls' => 'array'
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}

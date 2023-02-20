<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'petId',
        'quantity',
        'shipDate',
        'status',
        'complete',
    ];

    protected $casts = [
        'shiipDate' => 'datetime'
    ];
}

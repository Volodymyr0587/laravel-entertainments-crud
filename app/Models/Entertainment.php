<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entertainment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'url',
        'status',
    ];
}

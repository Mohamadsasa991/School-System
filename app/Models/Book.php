<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'file',
        'size',
        'chapter',
        'subject_id',
        'class_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'action_btn',
        'action_link',
        'section_id'
    ];

    public function section() {
        return $this->hasMany(cardSection::class,'id','section_id');
    }

    protected $casts = [
        // 'card' => 'array',
    ];
}

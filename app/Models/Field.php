<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_name',
        'field_type',
        'options',
        'required',
        'status',
        'form_name_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];
    public function formName()
    {
        return $this->belongsTo(FormName::class, 'form_name_id');
    }
}

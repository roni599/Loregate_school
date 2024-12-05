<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormName extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];
    public function fields()
    {
        return $this->hasMany(Field::class, 'form_name_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionType extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'code', 'main_document_id'];
}

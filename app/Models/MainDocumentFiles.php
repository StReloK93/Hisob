<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDocumentFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_document_id',
        'src',
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'todos';

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }
}

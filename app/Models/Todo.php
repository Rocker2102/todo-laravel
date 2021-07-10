<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'todos';
    protected $date_format = 'd-m-Y, H:i:s';

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    /* custom mutators */
    public function getCreatedAtAttribute($value) {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Kolkata')
            ->format($this->date_format);
    }

    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Kolkata')
            ->format($this->date_format);
    }

    /* FIXME: set according to the app timezone to prevent inconsistencies */
    public function getDueDateAttribute($value) {
        return isset($value) ? Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Kolkata')
            ->format($this->date_format) : null;
    }
}

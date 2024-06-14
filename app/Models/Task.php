<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function log()
    {
        return $this->belongsTo(DailyLog::class, 'log_id', 'id');
    }
}

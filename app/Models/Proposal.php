<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'freelancer_id',
        'task_id',
        'message',
        'status',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

}

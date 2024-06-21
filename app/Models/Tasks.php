<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tasks extends Model
{
    protected $table="tasks";

    public function list()
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }

}

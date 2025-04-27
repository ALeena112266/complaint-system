<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'complaint_id', 'message'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}


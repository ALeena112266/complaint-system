<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['complaint_id', 'file_path'];

    // Relationship with Complaint
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}


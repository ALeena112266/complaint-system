<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Allows mass assignment

    /**
     * A department has many complaints.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}


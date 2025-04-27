<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'status', 'priority'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function attachments()
{
    return $this->hasMany(ComplaintAttachment::class);
}
public function department()
{
    return $this->belongsTo(Department::class);
}
public function feedback()
{
    return $this->hasMany(Feedback::class);
}


}

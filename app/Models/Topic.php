<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Topic extends Model
{
    use HasFactory;
    use HasRelationships; // Add this line to enable hasManyDeep

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // Using hasManyThrough (Laravel's built-in feature)
    // public function episodes()
    // {
    //     return $this->hasManyThrough(Episode::class, Course::class);
    // }

    // Using hasManyDeep (staudenmeir/eloquent-has-many-deep)
    public function episodes()
    {
        return $this->hasManyDeep(Episode::class, [Course::class, Section::class]);
    }
}

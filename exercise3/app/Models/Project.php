<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'done_jobs',
        'jobs_count',
        'start_date',
        'end_date',
        'manager_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
        'done_jobs' => 'integer',
        'jobs_count' => 'integer',
    ];

    /**
     * Get the default value for jobs_count.
     */
    protected $attributes = [
        'jobs_count' => 0,
        'done_jobs' => 0,
    ];

    /**
     * Get the user that manages the project.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the members of the project.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }

    /**
     * Calculate the progress percentage.
     */
    public function getProgressPercentageAttribute()
    {
        if ($this->jobs_count <= 0) {
            return 0;
        }

        return min(100, round(($this->done_jobs / $this->jobs_count) * 100));
    }
}

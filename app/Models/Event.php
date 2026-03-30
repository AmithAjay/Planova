<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'date',
        'location',
        'created_by',
        'approval_status',
        'max_participants',
        'image_path',
        'ticket_price',
        'event_type',
        'custom_fields',
        'is_published',
        'organizing_departments',
        'is_open_to_all',
        'eligible_departments',
    ];

    protected $casts = [
        'date' => 'date',
        'custom_fields' => 'array',
        'is_published' => 'boolean',
        'organizing_departments' => 'array',
        'is_open_to_all' => 'boolean',
        'eligible_departments' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class , 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class , 'registrations')->withPivot('status')->withTimestamps();
    }

    public function team()
    {
        return $this->belongsToMany(User::class , 'event_user_roles')
            ->withPivot('role')
            ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_title',
        'description',
        'client_name',
        'project_cost',
        'model_link',
        'perspective_view',
        'floor_plans',
        'building_permit_number',
        'address_location',
        'latitude',
        'longitude',
        'project_status',
        'is_active',
        'created_by'
    ];
}

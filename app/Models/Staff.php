<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff';

    protected $fillable = [
        'staff_id',

        'first_name',
        'last_name',
        'other_name',

        'gender',
        'date_of_birth',
        'address',

        'email',
        'phone',

        'department_id',
        'position',
        'salary',
        'employment_date',
        'status',

        'profile_photo',

        'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'employment_date' => 'date',
        'salary' => 'decimal:2',
    ];


    /*
    |--------------------------------------------------------------------------
    | Department
    |--------------------------------------------------------------------------
    */

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    /*
    |--------------------------------------------------------------------------
    | User Account
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Full Name
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return trim(
            $this->first_name . ' ' .
            ($this->other_name ? $this->other_name . ' ' : '') .
            $this->last_name
        );
    }
}
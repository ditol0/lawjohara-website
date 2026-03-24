<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseRequest extends Model
{
    use HasFactory;

    protected $table = 'case_requests';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'case_type',
        'details',
        'status',
        'admin_notes',
    ];

    protected static function booted()
    {
        static::creating(function ($case) {
            if (empty($case->uuid)) {
                $case->uuid = (string) Str::uuid();
            }
        });
    }
}

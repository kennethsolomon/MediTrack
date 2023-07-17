<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix_name',
        'gender',
        'birth_date',
        'address',
        'place_of_birth',
        'civil_status',
        'religion',
        'nationality',
        'avatar',
        'status',
        'user_id',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }

    public function vitalsign()
    {
        return $this->hasMany(Vitalsign::class);
    }
}

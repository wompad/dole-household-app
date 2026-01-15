<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_households';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'father_name',
        'mother_name',
        'father_occupation',
        'mother_occupation',
        'home_address',
        'family_income',
        'house_status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'family_income' => 'float',
        ];
    }

    /**
     * Get the household members for the household.
     */
    public function members()
    {
        return $this->hasMany(HouseholdMember::class, 'household_id');
    }
}

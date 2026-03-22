<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CertificationCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class, 'category_id');
    }
}

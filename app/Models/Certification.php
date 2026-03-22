<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certification extends Model
{
    protected $fillable = [
        'title', 'issuer', 'issue_date', 'credential_url',
        'cover_image', 'category_id',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CertificationCategory::class, 'category_id');
    }
}

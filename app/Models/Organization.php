<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = ['name','code','description'];

    public function datasets(): HasMany
    {
        return $this->hasMany(Dataset::class);
    }
}
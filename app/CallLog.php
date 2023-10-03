<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallLog extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}

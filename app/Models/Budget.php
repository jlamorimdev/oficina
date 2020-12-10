<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Budget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'salesman_id',
        'description',
        'budget_date',
        'price'
    ];

    protected $dates = ['budget_date'];

    public function salesman(): BelongsTo
    {
        return $this->belongsTo(Salesman::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}

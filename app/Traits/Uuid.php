<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait Uuid
{
    /**
     * Boot function from laravel.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model): void
        {
            if (!$model->getIncrementing() && empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = RamseyUuid::uuid4()->toString();
            }
        });
    }
}

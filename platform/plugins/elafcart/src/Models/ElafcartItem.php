<?php

namespace Botble\Elafcart\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ElafcartItem extends BaseModel
{
    protected $table = 'elafcart_items';

    protected $fillable = [
        'name',
        'description',
        'content',
        'image',
        'status',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'is_featured' => 'bool',
    ];

    public function slugable(): MorphMany
    {
        return $this->morphMany(\Botble\Slug\Models\Slug::class, 'reference');
    }

    public function scopeWherePublished($query)
    {
        return $query->where('status', BaseStatusEnum::PUBLISHED);
    }
}

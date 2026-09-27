<?php

namespace Botble\Portfolio\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Project extends BaseModel
{
    protected $table = 'pf_projects';

    protected $fillable = [
        'name',
        'description',
        'content',
        'image',
        'images',
        'is_featured',
        'views',
        'status',
        'author',
        'place',
        'client',
        'order',
        'start_date',
        'metric_1_value',
        'metric_1_label',
        'metric_2_value',
        'metric_2_label',
        'metric_3_value',
        'metric_3_label',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'images' => 'array',
        'status' => BaseStatusEnum::class,
        'start_date' => 'date',
    ];
}

<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'unique'          => true,
        'on_update'       => true,
    );
    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'desc',
        'content',
        'image',
        'status',
        'views'
    ];

    protected $dates = ['created_at', 'updated_at', 'event_start', 'event_end'];

    /**
     * post belong to one category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopePublish($query)
    {
        $query->where('status', true);
    }

}

<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
        'unique'          => true,
        'on_update'       => true,
    );

    protected $fillable = [
        'name',      
        'parent_id',
        'slug',
        'desc',
        'image',
    ];

    /**
     * parent of this category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id', 'id');
    }

    /**
     * sub of this category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');

    }
    
    public function getListPostsAttribute()
    {
        if ($this->subCategories->count() == 0) {
            return Post::where('category_id', $this->id)
                ->where('status', true)
                ->orderBy('updated_at', 'desc')
                ->limit(6)
                ->get();
        } else {
            $categoryIds = $this->subCategories->lists('id')->all();
            $categoryIds[] = $this->id;
            return Post::whereIn('category_id', $categoryIds)
                ->where('status', true)
                ->orderBy('updated_at', 'desc')
                ->limit(6)
                ->get();
        }
    }

    public function indexPosts()
    {
        if ($this->subCategories->count() == 0) {
            return Post::where('category_id', $this->id)
                ->where('status', true)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            $categoryIds = $this->subCategories->lists('id')->all();
            $categoryIds[] = $this->id;
            return Post::whereIn('category_id', $categoryIds)
                ->where('status', true)
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        }
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class)->where('status', true)->orderBy('updated_at', 'desc');
    }
  
}

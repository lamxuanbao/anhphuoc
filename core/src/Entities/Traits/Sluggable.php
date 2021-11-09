<?php

namespace Kizi\Core\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

trait Sluggable
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::saving(
            function ($entity) {
                $entity->setSlug();
            }
        );
    }

    /**
     * Set the slug attribute.
     *
     * @param  string  $value
     *
     * @return void
     */
    public function setSlug()
    {
        $value = $this->getAttribute('slug');
        if (is_null($value)) {
            $value = $this->getAttribute($this->slugAttribute);
        }

        if ($value) {
            $this->attributes['slug'] = $this->generateSlug($value);
        }
    }

    /**
     * Generate slug by the given value.
     *
     * @param  string  $value
     *
     * @return string
     */
    private function generateSlug($value)
    {
        $slug = slugify($value);
        $query = $this->where(
            'slug',
            $slug
        )
            ->withoutGlobalScope('active')
            ->when(
                $this->getAttribute($this->primaryKey) !== null,
                function ($q) {
                    return $q->where(
                        $this->primaryKey,
                        '<>',
                        $this->getAttribute($this->primaryKey)
                    );
                }
            );

        if (Arr::has(class_uses($this), SoftDeletes::class)) {
            $query->withTrashed();
        }

        if ($query->exists()) {
            $slug .= '-'.Carbon::now()->timestamp;
        }
        $slug = slugify($slug);
        return $slug;
    }
}

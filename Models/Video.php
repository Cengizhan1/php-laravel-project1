<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    public $images = [
        'master',
        'thumb',
        [
            'key' => 'gallery',
            'multiple' => true,
            'edit' => true,
            'translation' => true,
            'video' => true,
        ],

    ];
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('crop')
            ->fit(Manipulations::FIT_CROP, 150, 200)
            ->performOnCollections('thumb')
            ->keepOriginalImageFormat();
        $this->addMediaConversion('crop')
            ->fit(Manipulations::FIT_CROP, 360, 360)
            ->performOnCollections('gallery')
            ->keepOriginalImageFormat();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video')->singleFile();

        $this
            ->addMediaCollection('thumb')
            ->useFallbackUrl('https://via.placeholder.com/' . (150) . 'x' . (200));
        $this
            ->addMediaCollection('gallery')
            ->useFallbackUrl('https://via.placeholder.com/'.(360).'x'.(360));
    }


}

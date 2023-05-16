<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Supervisor extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'wallet_id',
        'professional_desc',
        'is_delete',
        'service_content',
        'category_id',
        'bank_name',
        'iban',
    ];

    protected $translatable = [];

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
    public function user(){
        return $this->hasOne(User::class,'supervisor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('crop')
            ->nonQueued()
            ->fit(Manipulations::FIT_CROP, 570, 690)
            ->performOnCollections('introduction_video')
            ->keepOriginalImageFormat();
    }

    public function workingHours()
    {
        return $this->HasMany(WorkingHour::class);

    }

    public function workingPrices()
    {
        return $this->HasMany(WorkingPrice::class);

    }

    public function meets()
    {
        return $this->HasMany(Meet::class);
    }
    public function competencies()
    {
        return $this->HasMany(Competency::class);
    }
    public function educations()
    {
        return $this->HasMany(Education::class);
    }

}

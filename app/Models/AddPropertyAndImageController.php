<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    public $table = 'add_property_and_images';
    protected $fillable = [
        'property_name',
        'property_address',
        'property_type',
        'bedrooms',
        'bathrooms',
        'price',
        'lot_area',
        'floor_area',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}

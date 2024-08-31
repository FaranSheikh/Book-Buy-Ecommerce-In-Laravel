<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    public $uploadDir = '/assets/site/img/products/';

    protected $filable = ['product_id', 'image', 'image_type'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->uploadDir. $value,
        );
    }
}

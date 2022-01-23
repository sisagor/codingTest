<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'title', 'sku', 'description'
    ];


    /*
     * @return product variants
     */
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    /*
     * @return product variant prices
     */
    public function productVariantPrice()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id', 'id');
    }

}

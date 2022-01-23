<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{

    protected $fillable = ['product_variant_one', 'product_variant_two', 'product_variant_three', 'price', 'stock', 'product_id'];



    public function productVariantOne() {
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_one');
    }

    public function productVariantTwo() {
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_two');
    }

    public function productVariantThree() {
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_three');
    }





}

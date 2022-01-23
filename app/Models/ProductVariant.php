<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    protected $fillable = ['id', 'variant', 'product_id', 'variant_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function variant(){
        return $this->hasOne(Variant::class, 'id', 'variant_id');
    }

    public function variantPrice(){
        return $this->hasOne(ProductVariantPrice::class, 'id', 'variant_id');
    }

}

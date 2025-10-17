<?php
namespace Models;
class Product extends Model {
    protected string $table = 'products';
    protected array $fillable = ['name','sku','cylinder_weight_kg','price'];
}

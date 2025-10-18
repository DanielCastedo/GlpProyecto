<?php
namespace Models;

class SaleItem extends Model {
    protected string $table = 'sale_items';
    protected array $fillable = ['sale_id','product_id','qty','unit_price','subtotal'];
}

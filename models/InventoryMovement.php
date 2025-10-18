<?php
namespace Models;

class InventoryMovement extends Model {
    protected string $table = 'inventory_movements';
    protected array $fillable = ['product_id','date','type','qty','ref_table','ref_id'];
}


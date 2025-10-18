<?php
namespace Models;

class Sale extends Model {
    protected string $table = 'sales';
    protected array $fillable = [
        'date','customer_name','customer_phone','driver_id','route_id',
        'total','amount_paid','balance_due','status'
    ];
}

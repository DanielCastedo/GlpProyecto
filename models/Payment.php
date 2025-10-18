<?php
namespace Models;

class Payment extends Model {
    protected string $table = 'payments';
    protected array $fillable = ['sale_id','date','amount','method','ref'];
}

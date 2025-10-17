<?php
namespace Models;
class Truck extends Model {
    protected string $table = 'trucks';
    protected array $fillable = ['plate','model','capacity_units'];
}

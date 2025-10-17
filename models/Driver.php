<?php
namespace Models;
class Driver extends Model {
    protected string $table = 'drivers';
    protected array $fillable = ['name','phone','license','truck_id'];
}

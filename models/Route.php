<?php
namespace Models;
class Route extends Model {
    protected string $table = 'routes';
    protected array $fillable = ['name','description'];
}

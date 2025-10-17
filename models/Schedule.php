<?php
namespace Models;
class Schedule extends Model {
    protected string $table = 'schedules';
    protected array $fillable = ['route_id','day_of_week','start_time','end_time'];
}

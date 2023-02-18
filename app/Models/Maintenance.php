<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    /**
     * Disable timestamp
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The name of the table.
     *
     * @var string
     */
    protected $table = 'maintenance';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];
}

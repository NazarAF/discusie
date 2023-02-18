<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    protected $table = 'categories';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = "id_category";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
    ];

    /**
     * Get the post associated with the category.
     */
    public function channel() {
        return $this->hasMany(Channel::class, 'id_category');
    }
}

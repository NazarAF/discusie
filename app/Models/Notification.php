<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The name of the table.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = "id_notification";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'title',
        'body',
        'read',
        'type'
    ];

    /**
     * Get the user associated with the notification.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}

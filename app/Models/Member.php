<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
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
    protected $table = 'members';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = "id_member";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_channel',
        'role',
        'status'
    ];

    /**
     * Get the user associated with the channel.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function channel() {
        return $this->belongsTo(Channel::class, 'id_channel');
    }
}

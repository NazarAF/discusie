<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    /**
     * The name of the table.
     *
     * @var string
     */
    protected $table = 'channels';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = "id_channel";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_category',
        'id_user',
        'profile',
        'name',
        'invite',
        'permission'
    ];

    /**
     * Get the user associated with the channel.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function member() {
        return $this->hasMany(Member::class, 'id_channel');
    }

    /**
     * Count member of channel.
     */
    public function totalMember() {
        return $this->getRelation('member')->count();
    }
}

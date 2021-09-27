<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Hangout extends Model
{
    use HasFactory;
    protected $fillable = [
        'extern_agenda_id', 'extern_event_id', 'public'
    ];
    /**
     * Users that belong to the hangout.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'hangout_user', 'hangout_id', 'user_id');
    }
}

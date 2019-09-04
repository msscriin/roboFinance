<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\User as User;

class Transaction extends Model
{
    use Notifiable;

    protected $table = 'Transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SendSuma', 'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'idSender', 'idRecipient','ScoreSender', 'ScoreRecipient','updated_at',
    ];

    public function UserSender()
    {
        return $this->hasMany(User::class, 'id');
    }
}

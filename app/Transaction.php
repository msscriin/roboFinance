<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
use App\User as User;
use App\Purse as Purse;
use App\Exceptions\SendNegativeValue as SendNegativeValue;


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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function UserSender()
    {
        return $this->hasMany(User::class, 'id');
    }

    public static function setTransaction( array $dataTransaction ) : string
    {

        try{
            DB::transaction(function() use ( $dataTransaction ) {

                $purseSender = Purse::where('idUsers', $dataTransaction[0])->get();

                if((int)$purseSender[0]->suma < 0 || (int)$purseSender[0]->suma < (int)$dataTransaction[2] || $dataTransaction[2] < 0 ){
                   throw new SendNegativeValue();
                }

                $newBalanceSender = $purseSender[0]->suma - $dataTransaction[2];


                $transaction = new Transaction();

                $transaction->idSender = $dataTransaction[0];
                $transaction->idRecipient = $dataTransaction[1];
                $transaction->SendSuma = $dataTransaction[2];
                $transaction->created_at = date('Y-m-d H:i:s' );

                $transaction->save();

                Purse::where('idUsers', $dataTransaction[0])
                    ->update(['suma' => $newBalanceSender]);

                $purseRecipient = Purse::where('idUsers', $dataTransaction[1])->get();
                $newBalanceRecipient = $purseRecipient[0]->suma + $dataTransaction[2];
                Purse::where('idUsers', $dataTransaction[1])
                    ->update(['suma' => $newBalanceRecipient]);
            }, 3);
            $message = "Транзакция успешно завершена";
        } catch (SendNegativeValue $e){
            $message = "Отправлено некорректное значение, или на счету недостаточно средств для перевода";
        }
        return $message;
    }

}

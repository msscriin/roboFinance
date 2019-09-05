<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\User as User;
use App\Transaction as Transaction;
use \Validator;


class HomeController extends Controller
{
    /**
     * @param int $id
     * @return string
     **/
    public function getUsers( int $id = 0 ) : string
    {
        if( $id == 0 ){
            $objUsers = User::with('balance')->get();
        } else {
            $objUsers = User::with('balance')->where('id', $id)->get();
        }
        return json_encode($objUsers);
    }

    /**
     * @return string
     */
    public function getTransactions( int $id ) : string
    {
        $obTransaction = Transaction::with('UserSender')->where('idSender', $id)->get();
        return json_encode($obTransaction);
    }

    /**
     * @param int $id
     * @return string
     */
    public function setTransactions( int $id, Request $postRequest ) : string
    {

        $v = Validator::make($postRequest->all(), [
            'idRecipient' => 'required',
            'transfer' => 'required',
        ]);

        if ($v->fails() || $id === (int)$postRequest->idRecipient)
        {
            $message = "Получатель не зарегистрирован или вы пытаетесь осуществить перевод на свой счет.";
        } else {
            $message = Transaction::setTransaction( [$id, $postRequest->idRecipient, $postRequest->transfer] );
        }


        return $message;
    }
}

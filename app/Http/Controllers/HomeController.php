<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\User as User;
use App\Transaction as Transaction;

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
    public function setTransactions( int $id, Request $result ) : string
    {
        return json_encode("User added money");
    }
}

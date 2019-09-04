<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;

class HomeController extends Controller
{
    /**
     * @param int $id
     * @return string
     **/
    public function getUsers( int $id = 0 ) : string
    {
        return json_encode("Andrey");
    }

    /**
     * @return string
     */
    public function getTransactions( int $id ) : string
    {
        return json_encode("List transactions");
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

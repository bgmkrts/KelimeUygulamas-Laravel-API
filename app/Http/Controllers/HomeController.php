<?php

namespace App\Http\Controllers;

use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function mail($mail,$code,$name)
    {
        Mail::to($mail)->send(new SendMailable($name,$code));
        return 'Mail gönderildi';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//PANGGIL UserRepository YANG TELAH DIBUAT
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        //Instance repository UserRepository kedalam property $user
        $this->user = $user;

        $this->middleware('auth');
    }

    //METHOD INI BERFUNGSI UNTUK MENAMPILKAN DATA
    public function index()
    {
        //KARENA UserRepository TELAH ADA DIDALAM PROPERTY $user
        //MAKA PENGGUNAANNYA ADALAH $this->user->namaMethod()
        //DALAM HAL INI KITA AKAN MENGGUNAKAN getPaginate()
        //DIMANA METHOD INI MEMINTA PARAMETER JUMLAH DATA YANG AKAN DITAMPILKAN
        return $this->user->getPaginate(10);
    }

    //METHOD INI BERFUNGSI UNTUK MENAMPILKAN DATA YANG TELAH DIFILTER
    public function show($params)
    {
        //JIKA PARAMETER YANG DITERIMA BUKA NUMERIC
        if (!is_numeric($params)) {
            //MAKA MENGGUNAKAN METHOD findBy()
            //DENGAN MENGIRIMKAN PARAMETER YANG DIINGINKAN
            //UNTUK DIGUNAKAN MEMFILTER DATA
            return $this->user->findBy('email', $params);
        }
        //JIKA DIA ADALAH NUMERIC
        //MAKA MENGGUNAKAN METHOD find()
        //DENGAN MENGIRIMKAN ID YG AKAN DITAMPILKAN
        return $this->user->find($params);
    }
}

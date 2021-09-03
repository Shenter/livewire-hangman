<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WordRepository;

class GameController extends Controller
{
    public $wordRepository;

    public function __construct(WordRepository $repository)
    {
        $this->wordRepository = $repository;
    }

    public function index()
    {
        return view('game',['word'=>$this->wordRepository->generateWord()]);
    }



}

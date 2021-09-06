<?php

namespace App\Repositories;

class WordRepository
{



    public function generateWord():string
    {
        $array = ['ЯБЛОКО','МОРОЗ','ЗМЕЯ','РУЛЬ','ПУЛЬТ','СМЕЛОСТЬ','ЗРЕЛОСТЬ','УСПЕХ','ДОСПЕХ','ВИШНЯ','ДОЖДЬ'];
//        $array = ['ЯБЛОКО','МОРОЗ'];
        return $array[array_rand($array)];
    }
}

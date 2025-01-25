<?php

namespace App\Http\Controllers;



abstract class Controller
{
    public function cleanUpperCaseString($string): string
    {
        // remover os espaços em branco no início e fim de uma string
        // converter a string para uppercase (maiúsculas)
        return strtoupper(trim($string));
    }
}

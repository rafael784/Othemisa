<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ContaModel;

define("PESSOA_MOCK", "Maria José da Silva");

class Pessoa extends BaseController
{
    public function index()
    {   
        $fileList = glob('/');

        //Loop through the array that glob returned.
        foreach($fileList as $filename){
        //Simply print them out onto the screen.
            echo $filename, '<br>'; 
        }
        echo getcwd() . "\n";
    }
}

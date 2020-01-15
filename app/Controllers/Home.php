<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ContaModel;

define("PESSOA_MOCK", "Maria José da Silva");

class Home extends BaseController
{
	public function index()
	{
		echo view('templates/header');
		echo view('conta/login');
		echo view('templates/footer');	
	}
	public function signup()
	{
		echo view('templates/header');
		echo view('conta/signup');	
		echo view('templates/footer');	
	}
}

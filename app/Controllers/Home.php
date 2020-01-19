<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ContaModel;

define("PESSOA_MOCK", "Maria José da Silva");
session_start();
class Home extends BaseController
{
	public function index()
	{
		$this->checkRootLogon();

		echo view('templates/header');
		echo view('conta/login');
		echo view('templates/footer');	
	}
	
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use Config\Services;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Register extends BaseController
{

    protected $loginModel;
    protected $session = null;
	public function __construct()
	{
        $this->loginModel = new LoginModel();
        $this->session = Services::session();
	}

	public function index()
	{
		$data = array();
		if($this->session->get('user'))	
			return redirect()->to(base_url()."/Dashboard"); 
		else{
			if($this->session->get('email'))
				$data['email']=$this->session->get('email');
			return view('register',$data);
		}
	}

	public function insert()
	{
		if(isset($_POST['pwd'])){
			$_POST['pwd'] = $this->getEncriptionKey($_POST['pwd']);
		}
		$addUser = $this->loginModel->insertUser($_POST);
		if($addUser){
			$userData = $this->loginModel->verifyUser($_POST);
			if(count($userData)>0){
				$this->session->set('user',$userData[0]);
				$this->session->setFlashdata('loginMessage','Welcome to CITask...');
				return redirect()->to(base_url()."/Dashboard"); 
			}
			else
				return redirect()->to(base_url()."/Login");
		}
		else
			return redirect()->to(base_url()."/Register");
	}
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use Config\Services;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Login extends BaseController
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
			if($this->session->get('email')){
				$data['email']=$this->session->get('email');
				$user = $this->loginModel->verifyEmail($data);
				if(count($user)>0)
					return view('login',$data);
			}
			return view('login');
		}
	}

	public function checkEmail()
	{
		if(isset($_POST['emailID']) || $this->session->get('email')){
			if(!$this->session->get('email') && !isset($_POST['emailID'])){
				$this->session->set('email', $_POST['emailID']);
				$data['email'] = $this->session->get('email');
			}
			else
				$data['email'] = $_POST['emailID'];
			$this->session->set('email', $_POST['emailID']);
			$user = $this->loginModel->verifyEmail($data);
			if(count($user)>0)
				return view('login',$data);
			else
				return redirect()->to(base_url()."/Register"); 
		}
		else
			return view('login');
	}

	public function LoggedIn()
	{
		if(isset($_POST['password']) && $this->session->get('email')){
			$data['pwd'] = $this->getEncriptionKey($_POST['password']);
			$data['email'] = $this->session->get('email');
			$user = $this->loginModel->verifyUser($data);
			if(count($user)>0){
				$this->session->set('user',$user[0]);
				$this->session->setFlashdata('loginMessage','Welcome to CITask...');
				return redirect()->to(base_url()."/Dashboard"); 
			}
			else{
				$this->session->setFlashdata('loginMessage','Password is wrong...');
				return redirect()->to(base_url()."/Login"); 
			}
		}
		else
			return redirect()->to(base_url()."/Login"); 
	}

	public function logout()
	{      
		$this->session->destroy();
		return redirect()->to(base_url()."/Login");
	}

	public function getSubDept()
	{
		$data['dept'] = $this->loginModel->sub_dept($_POST['dept']);
		echo json_encode($data);
	}
}

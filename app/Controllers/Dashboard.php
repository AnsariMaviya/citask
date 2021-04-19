<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use Config\Services;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Dashboard extends BaseController
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
		if($this->session->get('user'))	{
			$user = $this->session->get('user');
			$data['email'] = $user->email;
			$data['id'] = $user->id;
			$data['data'] = $this->loginModel->verifyEmail($data)[0];
			$data['dept'] = $this->loginModel->department();
			$data['data']->pwd = $this->getDecriptionKey($data['data']->pwd);
			return view('dashboard',$data);
		}
		else
			return redirect()->to(base_url()."/Login"); 
	}

	public function upload_cropped_image($ids='', $folder, $action = 0,$code = '')
    {
        $data = $_POST["image"];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        if ($action > 0) {
            $newname = $_POST['id'] . '.png';
            file_put_contents(WRITEPATH . "../assets/$folder/$newname", $data);
            echo $newname;
            exit;
        }
        else{
            file_put_contents(WRITEPATH . "../assets/$folder/$ids", $data);
            echo $ids;
            exit;
        }
    }

    public function updateUser()
    {
		if($this->session->get('user'))	{
			$user = $this->session->get('user');
			$data['email'] = $user->email;
			$data['id'] = $user->id;
			$_POST['pwd'] = $this->getEncriptionKey($_POST['pwd']);
			$user = $this->loginModel->updateUser($_POST,$data);
			echo json_encode($user);
		}
    }
}

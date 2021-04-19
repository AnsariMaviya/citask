<?php

namespace App\Models;

use \CodeIgniter\Model;

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    function verifyEmail($data)
    {
        $query = $this->db->table('users')->getWhere($data);
        return $query->getResult();
    }

    function verifyUser($data)
    {
        $sql = "SELECT * FROM users where email='".$data['email']."' and pwd = '".$data['pwd']."'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    function department()
    {
        $sql = "SELECT * FROM department";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    function sub_dept($deptID)
    {
        $sql = "SELECT * FROM sub_department where id_dept=$deptID";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    function insertUser($data)
    {
        if($this->db->table('users')->insert($data))
            return true;
        else
            return false;
    }

    function updateUser($data,$where)
    {
        return $this->db->table('users')->update($data,$where);
    }
}

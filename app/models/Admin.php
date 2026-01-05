<?php

class Admin extends Model
{
    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM admin WHERE username = :username');
        $this->db->bind(':username', $username);
        
        $admin = $this->db->single();
        
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        
        return false;
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM admin WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePassword($id, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->db->query('UPDATE admin SET password = :password WHERE id = :id');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

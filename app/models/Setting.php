<?php

class Setting extends Model
{
    public function get()
    {
        $this->db->query('SELECT * FROM settings ORDER BY id DESC LIMIT 1');
        return $this->db->single();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE settings SET 
                school_name = :school_name,
                address = :address,
                phone = :phone,
                email = :email,
                website = :website,
                logo = :logo
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':school_name', $this->sanitize($data['school_name']));
        $this->db->bind(':address', $this->sanitize($data['address']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':website', $this->sanitize($data['website']));
        $this->db->bind(':logo', $data['logo']);
        
        return $this->db->execute();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO settings (school_name, address, phone, email, website, logo)
            VALUES (:school_name, :address, :phone, :email, :website, :logo)
        ');
        
        $this->db->bind(':school_name', $this->sanitize($data['school_name']));
        $this->db->bind(':address', $this->sanitize($data['address']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':website', $this->sanitize($data['website']));
        $this->db->bind(':logo', $data['logo']);
        
        return $this->db->execute();
    }
}

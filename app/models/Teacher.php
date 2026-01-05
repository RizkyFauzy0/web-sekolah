<?php

class Teacher extends Model
{
    public function getAll()
    {
        $this->db->query('SELECT * FROM teachers ORDER BY sort_order ASC, name ASC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM teachers WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO teachers (photo, name, subject, email, phone, description, sort_order)
            VALUES (:photo, :name, :subject, :email, :phone, :description, :sort_order)
        ');
        
        $this->db->bind(':photo', $data['photo']);
        $this->db->bind(':name', $this->sanitize($data['name']));
        $this->db->bind(':subject', $this->sanitize($data['subject']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':sort_order', $data['sort_order']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE teachers SET 
                photo = :photo,
                name = :name,
                subject = :subject,
                email = :email,
                phone = :phone,
                description = :description,
                sort_order = :sort_order
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':photo', $data['photo']);
        $this->db->bind(':name', $this->sanitize($data['name']));
        $this->db->bind(':subject', $this->sanitize($data['subject']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':sort_order', $data['sort_order']);
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM teachers WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

<?php

class Slider extends Model
{
    public function getAll()
    {
        $this->db->query('SELECT * FROM slider ORDER BY sort_order ASC');
        return $this->db->resultSet();
    }

    public function getActive()
    {
        $this->db->query('SELECT * FROM slider WHERE is_active = 1 ORDER BY sort_order ASC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM slider WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO slider (title, description, image, sort_order, is_active)
            VALUES (:title, :description, :image, :sort_order, :is_active)
        ');
        
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':is_active', $data['is_active']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE slider SET 
                title = :title,
                description = :description,
                image = :image,
                sort_order = :sort_order,
                is_active = :is_active
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':sort_order', $data['sort_order']);
        $this->db->bind(':is_active', $data['is_active']);
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM slider WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

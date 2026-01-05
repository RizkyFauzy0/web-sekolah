<?php

class Achievement extends Model
{
    public function getAll()
    {
        $this->db->query('SELECT * FROM achievements ORDER BY year DESC, created_at DESC');
        return $this->db->resultSet();
    }

    public function getByType($type)
    {
        $this->db->query('SELECT * FROM achievements WHERE type = :type ORDER BY year DESC, created_at DESC');
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM achievements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO achievements (type, title, description, year, image)
            VALUES (:type, :title, :description, :year, :image)
        ');
        
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':image', $data['image']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE achievements SET 
                type = :type,
                title = :title,
                description = :description,
                year = :year,
                image = :image
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':image', $data['image']);
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM achievements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

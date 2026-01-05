<?php

class AppLink extends Model
{
    public function getAll()
    {
        $this->db->query('SELECT * FROM app_links ORDER BY sort_order ASC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM app_links WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO app_links (name, url, icon, description, sort_order)
            VALUES (:name, :url, :icon, :description, :sort_order)
        ');
        
        $this->db->bind(':name', $this->sanitize($data['name']));
        $this->db->bind(':url', $this->sanitize($data['url']));
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':sort_order', $data['sort_order']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE app_links SET 
                name = :name,
                url = :url,
                icon = :icon,
                description = :description,
                sort_order = :sort_order
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $this->sanitize($data['name']));
        $this->db->bind(':url', $this->sanitize($data['url']));
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':description', $this->sanitize($data['description']));
        $this->db->bind(':sort_order', $data['sort_order']);
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM app_links WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

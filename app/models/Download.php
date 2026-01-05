<?php

class Download extends Model
{
    public function getAll()
    {
        $this->db->query('SELECT * FROM downloads ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getByCategory($category)
    {
        $this->db->query('SELECT * FROM downloads WHERE category = :category ORDER BY created_at DESC');
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM downloads WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO downloads (title, file_path, file_type, category, description)
            VALUES (:title, :file_path, :file_type, :category, :description)
        ');
        
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':file_type', $this->sanitize($data['file_type']));
        $this->db->bind(':category', $this->sanitize($data['category']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE downloads SET 
                title = :title,
                file_path = :file_path,
                file_type = :file_type,
                category = :category,
                description = :description
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':file_type', $this->sanitize($data['file_type']));
        $this->db->bind(':category', $this->sanitize($data['category']));
        $this->db->bind(':description', $this->sanitize($data['description']));
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM downloads WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function incrementDownloadCount($id)
    {
        $this->db->query('UPDATE downloads SET download_count = download_count + 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

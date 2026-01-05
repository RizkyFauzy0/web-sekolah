<?php

class Gallery extends Model
{
    public function getAllPhotos()
    {
        $this->db->query('SELECT * FROM gallery_photos ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getPhotosByCategory($category)
    {
        $this->db->query('SELECT * FROM gallery_photos WHERE category = :category ORDER BY created_at DESC');
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getPhotoById($id)
    {
        $this->db->query('SELECT * FROM gallery_photos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createPhoto($data)
    {
        $this->db->query('
            INSERT INTO gallery_photos (title, image, category, caption)
            VALUES (:title, :image, :category, :caption)
        ');
        
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category', $this->sanitize($data['category']));
        $this->db->bind(':caption', $this->sanitize($data['caption']));
        
        return $this->db->execute();
    }

    public function updatePhoto($data)
    {
        $this->db->query('
            UPDATE gallery_photos SET 
                title = :title,
                image = :image,
                category = :category,
                caption = :caption
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category', $this->sanitize($data['category']));
        $this->db->bind(':caption', $this->sanitize($data['caption']));
        
        return $this->db->execute();
    }

    public function deletePhoto($id)
    {
        $this->db->query('DELETE FROM gallery_photos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getAllVideos()
    {
        $this->db->query('SELECT * FROM gallery_videos ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getVideoById($id)
    {
        $this->db->query('SELECT * FROM gallery_videos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createVideo($data)
    {
        $this->db->query('
            INSERT INTO gallery_videos (title, video_url, thumbnail, description)
            VALUES (:title, :video_url, :thumbnail, :description)
        ');
        
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':video_url', $this->sanitize($data['video_url']));
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':description', $this->sanitize($data['description']));
        
        return $this->db->execute();
    }

    public function updateVideo($data)
    {
        $this->db->query('
            UPDATE gallery_videos SET 
                title = :title,
                video_url = :video_url,
                thumbnail = :thumbnail,
                description = :description
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':video_url', $this->sanitize($data['video_url']));
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':description', $this->sanitize($data['description']));
        
        return $this->db->execute();
    }

    public function deleteVideo($id)
    {
        $this->db->query('DELETE FROM gallery_videos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

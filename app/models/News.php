<?php

class News extends Model
{
    public function getAll($limit = null)
    {
        $query = 'SELECT * FROM news ORDER BY publish_date DESC, created_at DESC';
        if ($limit) {
            $query .= ' LIMIT ' . (int)$limit;
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getPublished($limit = null)
    {
        $query = 'SELECT * FROM news WHERE is_published = 1 ORDER BY publish_date DESC, created_at DESC';
        if ($limit) {
            $query .= ' LIMIT ' . (int)$limit;
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM news WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBySlug($slug)
    {
        $this->db->query('SELECT * FROM news WHERE slug = :slug');
        $this->db->bind(':slug', $slug);
        $news = $this->db->single();
        
        if ($news) {
            $this->incrementViews($news['id']);
        }
        
        return $news;
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO news (title, slug, content, image, author, publish_date, is_published)
            VALUES (:title, :slug, :content, :image, :author, :publish_date, :is_published)
        ');
        
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':slug', $this->createSlug($data['title']));
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':author', $this->sanitize($data['author']));
        $this->db->bind(':publish_date', $data['publish_date']);
        $this->db->bind(':is_published', $data['is_published']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE news SET 
                title = :title,
                slug = :slug,
                content = :content,
                image = :image,
                author = :author,
                publish_date = :publish_date,
                is_published = :is_published
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $this->sanitize($data['title']));
        $this->db->bind(':slug', $this->createSlug($data['title']));
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':author', $this->sanitize($data['author']));
        $this->db->bind(':publish_date', $data['publish_date']);
        $this->db->bind(':is_published', $data['is_published']);
        
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM news WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    private function createSlug($title)
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }

    private function incrementViews($id)
    {
        $this->db->query('UPDATE news SET views = views + 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}

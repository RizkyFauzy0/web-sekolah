<?php

class Profile extends Model
{
    public function get()
    {
        $this->db->query('SELECT * FROM profile ORDER BY id DESC LIMIT 1');
        return $this->db->single();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE profile SET 
                vision = :vision,
                mission = :mission,
                history = :history,
                organizational_structure = :organizational_structure,
                advantages = :advantages
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':vision', $this->sanitize($data['vision']));
        $this->db->bind(':mission', $this->sanitize($data['mission']));
        $this->db->bind(':history', $this->sanitize($data['history']));
        $this->db->bind(':organizational_structure', $data['organizational_structure']);
        $this->db->bind(':advantages', $this->sanitize($data['advantages']));
        
        return $this->db->execute();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO profile (vision, mission, history, organizational_structure, advantages)
            VALUES (:vision, :mission, :history, :organizational_structure, :advantages)
        ');
        
        $this->db->bind(':vision', $this->sanitize($data['vision']));
        $this->db->bind(':mission', $this->sanitize($data['mission']));
        $this->db->bind(':history', $this->sanitize($data['history']));
        $this->db->bind(':organizational_structure', $data['organizational_structure']);
        $this->db->bind(':advantages', $this->sanitize($data['advantages']));
        
        return $this->db->execute();
    }
}

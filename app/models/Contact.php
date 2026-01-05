<?php

class Contact extends Model
{
    public function get()
    {
        $this->db->query('SELECT * FROM contact ORDER BY id DESC LIMIT 1');
        return $this->db->single();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE contact SET 
                address = :address,
                phone = :phone,
                email = :email,
                whatsapp = :whatsapp,
                facebook = :facebook,
                instagram = :instagram,
                twitter = :twitter,
                youtube = :youtube,
                maps_embed = :maps_embed
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':address', $this->sanitize($data['address']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':whatsapp', $this->sanitize($data['whatsapp']));
        $this->db->bind(':facebook', $this->sanitize($data['facebook']));
        $this->db->bind(':instagram', $this->sanitize($data['instagram']));
        $this->db->bind(':twitter', $this->sanitize($data['twitter']));
        $this->db->bind(':youtube', $this->sanitize($data['youtube']));
        $this->db->bind(':maps_embed', $data['maps_embed']);
        
        return $this->db->execute();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO contact (address, phone, email, whatsapp, facebook, instagram, twitter, youtube, maps_embed)
            VALUES (:address, :phone, :email, :whatsapp, :facebook, :instagram, :twitter, :youtube, :maps_embed)
        ');
        
        $this->db->bind(':address', $this->sanitize($data['address']));
        $this->db->bind(':phone', $this->sanitize($data['phone']));
        $this->db->bind(':email', $this->sanitize($data['email']));
        $this->db->bind(':whatsapp', $this->sanitize($data['whatsapp']));
        $this->db->bind(':facebook', $this->sanitize($data['facebook']));
        $this->db->bind(':instagram', $this->sanitize($data['instagram']));
        $this->db->bind(':twitter', $this->sanitize($data['twitter']));
        $this->db->bind(':youtube', $this->sanitize($data['youtube']));
        $this->db->bind(':maps_embed', $data['maps_embed']);
        
        return $this->db->execute();
    }
}

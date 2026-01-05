<?php

class Student extends Model
{
    public function getCurrent()
    {
        $currentYear = date('Y');
        $this->db->query('SELECT * FROM students WHERE year = :year ORDER BY id DESC LIMIT 1');
        $this->db->bind(':year', $currentYear);
        return $this->db->single();
    }

    public function getByYear($year)
    {
        $this->db->query('SELECT * FROM students WHERE year = :year');
        $this->db->bind(':year', $year);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query('
            INSERT INTO students (total_students, male_students, female_students, year)
            VALUES (:total_students, :male_students, :female_students, :year)
        ');
        
        $this->db->bind(':total_students', $data['total_students']);
        $this->db->bind(':male_students', $data['male_students']);
        $this->db->bind(':female_students', $data['female_students']);
        $this->db->bind(':year', $data['year']);
        
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('
            UPDATE students SET 
                total_students = :total_students,
                male_students = :male_students,
                female_students = :female_students
            WHERE id = :id
        ');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':total_students', $data['total_students']);
        $this->db->bind(':male_students', $data['male_students']);
        $this->db->bind(':female_students', $data['female_students']);
        
        return $this->db->execute();
    }
}

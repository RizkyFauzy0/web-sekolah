<?php

/**
 * Database Migration Script
 * This script creates all necessary tables for the school website
 * Run this file once to setup the database
 */

// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'web_sekolah';

try {
    // Create database connection
    $conn = new PDO("mysql:host=$host", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $conn->exec("CREATE DATABASE IF NOT EXISTS $db_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->exec("USE $db_name");
    
    echo "Database '$db_name' created successfully\n\n";
    
    // Admin table
    $conn->exec("DROP TABLE IF EXISTS admin");
    $conn->exec("
        CREATE TABLE admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'admin' created\n";
    
    // Settings table
    $conn->exec("DROP TABLE IF EXISTS settings");
    $conn->exec("
        CREATE TABLE settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            school_name VARCHAR(200) NOT NULL,
            address TEXT NOT NULL,
            phone VARCHAR(20),
            email VARCHAR(100),
            website VARCHAR(100),
            logo VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'settings' created\n";
    
    // Slider table
    $conn->exec("DROP TABLE IF EXISTS slider");
    $conn->exec("
        CREATE TABLE slider (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(200),
            description TEXT,
            image VARCHAR(255) NOT NULL,
            sort_order INT DEFAULT 0,
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'slider' created\n";
    
    // News table
    $conn->exec("DROP TABLE IF EXISTS news");
    $conn->exec("
        CREATE TABLE news (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) UNIQUE NOT NULL,
            content TEXT NOT NULL,
            image VARCHAR(255),
            author VARCHAR(100),
            publish_date DATE NOT NULL,
            is_published TINYINT(1) DEFAULT 1,
            views INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'news' created\n";
    
    // Teachers table
    $conn->exec("DROP TABLE IF EXISTS teachers");
    $conn->exec("
        CREATE TABLE teachers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            photo VARCHAR(255),
            name VARCHAR(100) NOT NULL,
            subject VARCHAR(100) NOT NULL,
            email VARCHAR(100),
            phone VARCHAR(20),
            description TEXT,
            sort_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'teachers' created\n";
    
    // Students table (for statistics)
    $conn->exec("DROP TABLE IF EXISTS students");
    $conn->exec("
        CREATE TABLE students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            total_students INT NOT NULL DEFAULT 0,
            male_students INT NOT NULL DEFAULT 0,
            female_students INT NOT NULL DEFAULT 0,
            year INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'students' created\n";
    
    // Profile table
    $conn->exec("DROP TABLE IF EXISTS profile");
    $conn->exec("
        CREATE TABLE profile (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vision TEXT,
            mission TEXT,
            history TEXT,
            organizational_structure VARCHAR(255),
            advantages TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'profile' created\n";
    
    // Gallery photos table
    $conn->exec("DROP TABLE IF EXISTS gallery_photos");
    $conn->exec("
        CREATE TABLE gallery_photos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(200),
            image VARCHAR(255) NOT NULL,
            category VARCHAR(50),
            caption TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'gallery_photos' created\n";
    
    // Gallery videos table
    $conn->exec("DROP TABLE IF EXISTS gallery_videos");
    $conn->exec("
        CREATE TABLE gallery_videos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(200) NOT NULL,
            video_url VARCHAR(255) NOT NULL,
            thumbnail VARCHAR(255),
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'gallery_videos' created\n";
    
    // Achievements table
    $conn->exec("DROP TABLE IF EXISTS achievements");
    $conn->exec("
        CREATE TABLE achievements (
            id INT AUTO_INCREMENT PRIMARY KEY,
            type ENUM('siswa', 'guru', 'sekolah') NOT NULL,
            title VARCHAR(200) NOT NULL,
            description TEXT,
            year INT NOT NULL,
            image VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'achievements' created\n";
    
    // Downloads table
    $conn->exec("DROP TABLE IF EXISTS downloads");
    $conn->exec("
        CREATE TABLE downloads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(200) NOT NULL,
            file_path VARCHAR(255) NOT NULL,
            file_type VARCHAR(50),
            category VARCHAR(50),
            description TEXT,
            download_count INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'downloads' created\n";
    
    // App links table
    $conn->exec("DROP TABLE IF EXISTS app_links");
    $conn->exec("
        CREATE TABLE app_links (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            url VARCHAR(255) NOT NULL,
            icon VARCHAR(255),
            description TEXT,
            sort_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'app_links' created\n";
    
    // Contact table
    $conn->exec("DROP TABLE IF EXISTS contact");
    $conn->exec("
        CREATE TABLE contact (
            id INT AUTO_INCREMENT PRIMARY KEY,
            address TEXT NOT NULL,
            phone VARCHAR(20),
            email VARCHAR(100),
            whatsapp VARCHAR(20),
            facebook VARCHAR(255),
            instagram VARCHAR(255),
            twitter VARCHAR(255),
            youtube VARCHAR(255),
            maps_embed TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table 'contact' created\n";
    
    echo "\n=== Inserting sample data ===\n\n";
    
    // Insert default admin (password: admin123)
    $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->exec("
        INSERT INTO admin (username, password, email, full_name) 
        VALUES ('admin', '$hashedPassword', 'admin@sekolah.com', 'Administrator')
    ");
    echo "Default admin created (username: admin, password: admin123)\n";
    
    // Insert default settings
    $conn->exec("
        INSERT INTO settings (school_name, address, phone, email, website) 
        VALUES (
            'SMA Negeri 1 Contoh',
            'Jl. Pendidikan No. 123, Jakarta Selatan',
            '(021) 1234567',
            'info@smansacontoh.sch.id',
            'www.smansacontoh.sch.id'
        )
    ");
    echo "Default settings created\n";
    
    // Insert sample profile
    $conn->exec("
        INSERT INTO profile (vision, mission, history, advantages) 
        VALUES (
            'Menjadi sekolah unggulan yang menghasilkan generasi cerdas, berkarakter, dan berwawasan global',
            '1. Menyelenggarakan pendidikan berkualitas\n2. Mengembangkan potensi siswa secara optimal\n3. Membentuk karakter siswa yang berakhlak mulia\n4. Menerapkan teknologi dalam pembelajaran',
            'SMA Negeri 1 Contoh didirikan pada tahun 1990 dengan komitmen untuk memberikan pendidikan berkualitas tinggi kepada generasi muda Indonesia. Selama lebih dari 30 tahun, sekolah ini telah menghasilkan ribuan alumni yang sukses di berbagai bidang.',
            '1. Guru berkualitas dan berpengalaman\n2. Fasilitas lengkap dan modern\n3. Program ekstrakurikuler beragam\n4. Prestasi akademik dan non-akademik yang membanggakan\n5. Lingkungan belajar yang kondusif'
        )
    ");
    echo "Sample profile created\n";
    
    // Insert sample teachers
    $conn->exec("
        INSERT INTO teachers (name, subject, email, sort_order) VALUES
        ('Drs. Ahmad Hidayat, M.Pd', 'Matematika', 'ahmad@sekolah.com', 1),
        ('Sri Wahyuni, S.Pd', 'Bahasa Indonesia', 'sri@sekolah.com', 2),
        ('Budi Santoso, S.Si', 'Fisika', 'budi@sekolah.com', 3),
        ('Dewi Lestari, S.Pd', 'Bahasa Inggris', 'dewi@sekolah.com', 4)
    ");
    echo "Sample teachers created\n";
    
    // Insert sample students statistics
    $currentYear = date('Y');
    $conn->exec("
        INSERT INTO students (total_students, male_students, female_students, year) 
        VALUES (450, 220, 230, $currentYear)
    ");
    echo "Sample student statistics created\n";
    
    // Insert sample news
    $conn->exec("
        INSERT INTO news (title, slug, content, author, publish_date, is_published) VALUES
        ('Penerimaan Siswa Baru Tahun Ajaran 2024/2025', 'penerimaan-siswa-baru-2024-2025', 'SMA Negeri 1 Contoh membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025. Pendaftaran dibuka mulai tanggal 1 Juni hingga 30 Juni 2024.', 'Admin', CURDATE(), 1),
        ('Prestasi Gemilang di Olimpiade Sains Nasional', 'prestasi-olimpiade-sains-nasional', 'Siswa SMA Negeri 1 Contoh meraih medali emas di Olimpiade Sains Nasional bidang Matematika dan Fisika.', 'Admin', CURDATE(), 1),
        ('Pelaksanaan Ujian Tengah Semester', 'pelaksanaan-ujian-tengah-semester', 'Ujian Tengah Semester akan dilaksanakan pada minggu depan. Siswa dimohon untuk mempersiapkan diri dengan baik.', 'Admin', CURDATE(), 1)
    ");
    echo "Sample news created\n";
    
    // Insert sample achievements
    $conn->exec("
        INSERT INTO achievements (type, title, description, year) VALUES
        ('siswa', 'Juara 1 Olimpiade Matematika Tingkat Nasional', 'Ahmad Rizki meraih juara 1 pada Olimpiade Matematika tingkat nasional', 2024),
        ('guru', 'Guru Berprestasi Tingkat Provinsi', 'Ibu Sri Wahyuni terpilih sebagai guru berprestasi tingkat provinsi', 2024),
        ('sekolah', 'Sekolah Adiwiyata Tingkat Nasional', 'SMA Negeri 1 Contoh meraih penghargaan Sekolah Adiwiyata tingkat nasional', 2023)
    ");
    echo "Sample achievements created\n";
    
    // Insert sample app links
    $conn->exec("
        INSERT INTO app_links (name, url, description, sort_order) VALUES
        ('Portal Siswa', 'https://portal.sekolah.com', 'Akses portal siswa untuk melihat nilai dan jadwal', 1),
        ('E-Learning', 'https://elearning.sekolah.com', 'Platform pembelajaran online', 2),
        ('Perpustakaan Digital', 'https://library.sekolah.com', 'Akses koleksi buku digital', 3)
    ");
    echo "Sample app links created\n";
    
    // Insert sample contact info
    $conn->exec("
        INSERT INTO contact (address, phone, email, whatsapp, facebook, instagram) VALUES
        (
            'Jl. Pendidikan No. 123, Jakarta Selatan, DKI Jakarta 12345',
            '(021) 1234567',
            'info@smansacontoh.sch.id',
            '081234567890',
            'https://facebook.com/smansacontoh',
            'https://instagram.com/smansacontoh'
        )
    ");
    echo "Sample contact info created\n";
    
    echo "\n=== Database migration completed successfully! ===\n";
    echo "You can now login to admin panel with:\n";
    echo "Username: admin\n";
    echo "Password: admin123\n";
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}

# Website Sekolah - PHP Native MVC

Website sekolah modern dan responsive yang dibangun menggunakan **PHP Native** dengan arsitektur **MVC (Model-View-Controller)** dan **Tailwind CSS** untuk styling.

## 🚀 Fitur Utama

### Frontend (Halaman Publik)
- **Dashboard/Homepage** dengan slider otomatis
- **Profil Sekolah** (Visi Misi, Sejarah, Struktur Organisasi, Keunggulan)
- **Berita Sekolah** dengan sistem slug dan view counter
- **Galeri Foto & Video**
- **Prestasi** (Siswa, Guru, Sekolah)
- **Download** dengan tracking download count
- **Link Aplikasi** eksternal
- **Kontak** dengan Google Maps integration
- **Statistics Counter** dengan animasi
- **Responsive Design** untuk semua ukuran layar
- **WhatsApp Floating Button**

### Backend (Admin Panel)
- **Dashboard Admin** dengan statistik
- **Login System** dengan session management
- **CRUD Management** untuk:
  - Pengaturan Sekolah
  - Slider/Carousel
  - Berita
  - Data Guru
  - Data Siswa (Statistik)
  - Profil Sekolah
  - Galeri Foto
  - Galeri Video
  - Prestasi
  - Download Files
  - Link Aplikasi
  - Kontak & Maps
- **Modal Popup** untuk form input (tanpa redirect)
- **DataTables** untuk list data yang rapi
- **AJAX Operations** untuk seamless experience
- **File Upload** dengan validasi

## 📋 Requirements

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache Web Server dengan mod_rewrite enabled
- Browser modern (Chrome, Firefox, Safari, Edge)

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/RizkyFauzy0/web-sekolah.git
cd web-sekolah
```

### 2. Setup Database

Buat database MySQL baru:

```sql
CREATE DATABASE web_sekolah;
```

Jalankan migration script untuk membuat tabel dan sample data:

```bash
php database/migration.php
```

Atau import manual melalui phpMyAdmin dengan menjalankan isi file `database/migration.php`.

### 3. Konfigurasi Database

Edit file `config/config.php` sesuai dengan konfigurasi database Anda:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_sekolah');
```

### 4. Konfigurasi Base URL

Edit `BASE_URL` di `config/config.php` sesuai dengan lokasi instalasi:

```php
// Jika di localhost
define('BASE_URL', 'http://localhost/web-sekolah/public/');

// Jika di subdomain/domain
define('BASE_URL', 'http://yourdomain.com/');
```

### 5. Setup Apache Virtual Host (Opsional)

Untuk production atau clean URL yang lebih baik, setup virtual host:

```apache
<VirtualHost *:80>
    ServerName yourschool.local
    DocumentRoot "/path/to/web-sekolah/public"
    
    <Directory "/path/to/web-sekolah/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 6. Set Permissions

Pastikan folder public memiliki permission untuk write (untuk upload):

```bash
chmod -R 755 public/
chmod -R 777 public/images/
chmod -R 777 public/files/
```

## 📱 Akses Aplikasi

### Frontend (Public)
```
http://localhost/web-sekolah/public/
```

### Backend (Admin)
```
http://localhost/web-sekolah/public/admin
```

**Default Admin Credentials:**
- Username: `admin`
- Password: `admin123`

⚠️ **PENTING:** Segera ubah password default setelah login pertama kali!

## 📁 Struktur Folder

```
web-sekolah/
├── app/
│   ├── controllers/     # Controller files
│   │   ├── HomeController.php
│   │   └── AdminController.php
│   ├── models/          # Model files
│   │   ├── Admin.php
│   │   ├── News.php
│   │   └── ...
│   ├── views/           # View files
│   │   ├── layouts/     # Layout templates
│   │   ├── home/        # Frontend views
│   │   └── admin/       # Backend views
│   └── core/            # Core MVC classes
│       ├── App.php
│       ├── Controller.php
│       ├── Database.php
│       └── Model.php
├── config/
│   └── config.php       # Configuration file
├── database/
│   └── migration.php    # Database migration
├── public/              # Public accessible folder
│   ├── css/
│   ├── js/
│   ├── images/          # Uploaded images
│   ├── files/           # Uploaded files
│   ├── .htaccess
│   └── index.php        # Entry point
├── .htaccess            # Root htaccess
└── README.md
```

## 🎨 Teknologi yang Digunakan

- **PHP Native** - Backend programming
- **MySQL** - Database
- **MVC Pattern** - Arsitektur aplikasi
- **PDO** - Database connection dengan prepared statements
- **Tailwind CSS** - UI Framework (via CDN)
- **jQuery** - AJAX operations
- **DataTables** - Table management
- **Font Awesome** - Icons

## 🔒 Keamanan

- Password hashing menggunakan PHP `password_hash()`
- Prepared statements untuk mencegah SQL injection
- XSS protection dengan `htmlspecialchars()`
- File upload validation
- Session management dengan secure settings
- CSRF token ready (dapat ditambahkan)

## 📝 Panduan Penggunaan

### Menambah Berita
1. Login ke admin panel
2. Klik menu "Berita"
3. Klik tombol "Tambah Berita"
4. Isi form dan upload gambar
5. Klik "Simpan"

### Mengelola Slider
1. Login ke admin panel
2. Klik menu "Slider"
3. Tambah/Edit/Hapus slider sesuai kebutuhan
4. Atur urutan tampilan dengan field "Urutan"
5. Toggle status Aktif/Nonaktif

### Upload Galeri Foto
1. Login ke admin panel
2. Klik menu "Galeri Foto"
3. Klik "Tambah Foto"
4. Upload gambar dan isi informasi
5. Klik "Simpan"

### Mengubah Kontak & Maps
1. Login ke admin panel
2. Klik menu "Kontak"
3. Edit informasi kontak
4. Paste Google Maps embed code
5. Klik "Simpan"

## 🐛 Troubleshooting

### Clean URL tidak bekerja
Pastikan mod_rewrite Apache enabled:
```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

### Error database connection
- Cek kredensial database di `config/config.php`
- Pastikan MySQL service running
- Pastikan database sudah dibuat

### Upload file gagal
- Cek permission folder `public/images/` dan `public/files/`
- Cek `upload_max_filesize` di php.ini
- Cek `post_max_size` di php.ini

### Session error
- Cek permission folder session PHP
- Pastikan session.save_path accessible

## 📞 Support

Untuk pertanyaan atau issue, silakan buat issue di GitHub repository atau hubungi developer.

## 📄 License

This project is open-source and available under the MIT License.

## 👨‍💻 Developer

Developed by [RizkyFauzy0](https://github.com/RizkyFauzy0)

---

⭐ Jangan lupa berikan star jika project ini bermanfaat!

# Installation & Setup Guide

## Quick Start (5 Minutes)

### Step 1: Clone or Download
```bash
git clone https://github.com/RizkyFauzy0/web-sekolah.git
cd web-sekolah
```

### Step 2: Create Database
Open phpMyAdmin or MySQL CLI and create a database:
```sql
CREATE DATABASE web_sekolah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 3: Run Migration
Navigate to the migration script in your browser or run via CLI:

**Via Browser:**
```
http://localhost/web-sekolah/database/migration.php
```

**Via CLI:**
```bash
php database/migration.php
```

You should see:
```
Database 'web_sekolah' created successfully
Table 'admin' created
Table 'settings' created
...
Database migration completed successfully!
```

### Step 4: Configure Database Connection
Edit `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'web_sekolah');

define('BASE_URL', 'http://localhost/web-sekolah/public/');
```

### Step 5: Set Permissions
```bash
chmod -R 755 public/
chmod -R 777 public/images/
chmod -R 777 public/files/
```

### Step 6: Access the Application

**Frontend (Public Website):**
```
http://localhost/web-sekolah/public/
```

**Admin Panel:**
```
http://localhost/web-sekolah/public/admin
Username: admin
Password: admin123
```

---

## Production Deployment

### 1. Server Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache with mod_rewrite
- At least 512MB RAM
- 1GB disk space

### 2. Upload Files
Upload all files to your web hosting via FTP/SFTP:
```
/public_html/
├── app/
├── config/
├── database/
├── public/
└── .htaccess
```

### 3. Configure for Production

Edit `config/config.php`:
```php
// Production database
define('DB_HOST', 'your-db-host');
define('DB_USER', 'your-db-user');
define('DB_PASS', 'your-db-password');
define('DB_NAME', 'your-db-name');

// Production URL
define('BASE_URL', 'https://yourdomain.com/');

// Enable HTTPS for sessions
ini_set('session.cookie_secure', 1);
```

### 4. Create Database
Use cPanel, phpMyAdmin, or MySQL CLI to create the database and run migration.php

### 5. Setup Document Root
Point your domain to the `/public` folder:
```
Document Root: /path/to/web-sekolah/public
```

Or create a symbolic link:
```bash
ln -s /path/to/web-sekolah/public /var/www/html/yoursite
```

### 6. Configure Apache Virtual Host
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot "/path/to/web-sekolah/public"
    
    <Directory "/path/to/web-sekolah/public">
        AllowOverride All
        Require all granted
    </Directory>
    
    # Redirect to HTTPS
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</VirtualHost>

<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot "/path/to/web-sekolah/public"
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    
    <Directory "/path/to/web-sekolah/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 7. Security Checklist
- [ ] Change default admin password
- [ ] Set proper file permissions (755 for folders, 644 for files)
- [ ] Enable HTTPS
- [ ] Configure firewall
- [ ] Regular backups
- [ ] Update PHP to latest version
- [ ] Disable error display in production

---

## Docker Deployment (Optional)

Create `Dockerfile`:
```dockerfile
FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY . /var/www/html/
WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html/public
```

Create `docker-compose.yml`:
```yaml
version: '3.8'
services:
  web:
    build: .
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www/html
    depends_on:
      - db
  db:
    image: mysql:5.7
    environment:
      MYSQL_DATABASE: web_sekolah
      MYSQL_ROOT_PASSWORD: root
    ports:
      - "3306:3306"
```

Run:
```bash
docker-compose up -d
```

---

## First Time Setup

### 1. Login to Admin Panel
```
URL: http://yoursite.com/admin
Username: admin
Password: admin123
```

### 2. Change Admin Password
Navigate to your profile and update the password immediately!

### 3. Update School Settings
Go to "Pengaturan Sekolah" and fill in:
- School name
- Address
- Contact information
- Upload school logo

### 4. Add Content
1. **Slider**: Add 3-5 attractive images for homepage
2. **Profile**: Fill in Vision, Mission, History, Advantages
3. **Teachers**: Add teacher profiles with photos
4. **News**: Publish your first news article
5. **Gallery**: Upload school activity photos
6. **Achievements**: Add student/teacher achievements

### 5. Configure Contact
- Add social media links
- Embed Google Maps
- Set WhatsApp number

---

## Troubleshooting

### Issue: "Database connection failed"
**Solution:**
1. Check database credentials in `config/config.php`
2. Ensure MySQL service is running
3. Verify database exists: `SHOW DATABASES;`

### Issue: "Page not found" / Clean URLs not working
**Solution:**
1. Enable mod_rewrite: `sudo a2enmod rewrite`
2. Restart Apache: `sudo service apache2 restart`
3. Check `.htaccess` files exist in root and public folders
4. Verify `AllowOverride All` in Apache config

### Issue: "Cannot upload files"
**Solution:**
1. Check folder permissions:
```bash
chmod -R 777 public/images/
chmod -R 777 public/files/
```
2. Check PHP upload limits in `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

### Issue: "Session not working"
**Solution:**
1. Check session directory permissions
2. Verify session.save_path is writable
3. Check PHP session configuration

### Issue: DataTables not loading
**Solution:**
1. Check internet connection (uses CDN)
2. Check browser console for errors
3. Clear browser cache

---

## Maintenance

### Regular Backups
```bash
# Database backup
mysqldump -u root -p web_sekolah > backup_$(date +%Y%m%d).sql

# Files backup
tar -czf backup_files_$(date +%Y%m%d).tar.gz public/images/ public/files/
```

### Update Content
Login to admin panel regularly to:
- Publish new articles
- Update school information
- Add new photos
- Manage achievements

### Monitor
- Check error logs: `tail -f /var/log/apache2/error.log`
- Monitor disk space
- Review access logs

---

## Support

For issues or questions:
1. Check this guide
2. Review README.md
3. Check GitHub Issues
4. Contact developer

---

## Useful Commands

```bash
# Check PHP version
php -v

# Check Apache status
sudo systemctl status apache2

# Restart Apache
sudo systemctl restart apache2

# Check MySQL status
sudo systemctl status mysql

# View Apache error log
tail -f /var/log/apache2/error.log

# Check file permissions
ls -la public/
```

---

**Last Updated:** 2026-01-05
**Version:** 1.0.0

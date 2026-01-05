# Nginx / aaPanel Installation Guide

## For aaPanel with Nginx

### Step 1: Upload Files
Upload all files to your aaPanel website directory:
```
/www/wwwroot/websekolah.gdvmedia.my.id/
├── app/
├── config/
├── database/
├── public/
├── nginx.conf (reference file)
└── README.md
```

### Step 2: Configure Database
1. Create database via aaPanel Database Manager
2. Edit `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'web_sekolah');

define('BASE_URL', 'https://websekolah.gdvmedia.my.id/');
```

### Step 3: Run Migration
Access via browser:
```
https://websekolah.gdvmedia.my.id/database/migration.php
```

Or via SSH:
```bash
cd /www/wwwroot/websekolah.gdvmedia.my.id
php database/migration.php
```

### Step 4: Configure Nginx in aaPanel

**IMPORTANT:** The document root MUST point to the `public` folder!

1. Go to aaPanel → Website → Your Site → Site Directory
2. Set **Running Directory** to `/public`
3. Enable **Prevent Cross-site Access**

#### Method A: Using aaPanel Interface (Recommended)

1. Go to **Website** → Click your domain
2. Click **Config Files** → **Configuration File**
3. Update the `root` directive to point to the `public` folder:
   ```nginx
   root /www/wwwroot/websekolah.gdvmedia.my.id/public;
   ```

4. Add this location block BEFORE the existing PHP location block:
   ```nginx
   location / {
       try_files $uri $uri/ /index.php?url=$uri&$args;
   }
   ```

5. Make sure the PHP location block looks like this:
   ```nginx
   location ~ \.php$ {
       try_files $uri =404;
       fastcgi_pass unix:/tmp/php-cgi-74.sock;
       fastcgi_index index.php;
       fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       include fastcgi_params;
   }
   ```

6. Click **Save** and **Restart** Nginx

#### Method B: Manual Configuration Reference

See the `nginx.conf` file in the root directory for a complete example configuration.

### Step 5: Set File Permissions

```bash
cd /www/wwwroot/websekolah.gdvmedia.my.id
chmod -R 755 public/
chmod -R 777 public/images/
chmod -R 777 public/files/
```

Or via aaPanel: File Manager → Right-click folder → Permission

### Step 6: Verify Configuration

1. **Check document root:**
   - aaPanel → Website → Your Site → Site Directory
   - Running Directory should be `/public`

2. **Check Nginx config:**
   - aaPanel → Website → Your Site → Config Files
   - Verify `root` points to `.../public`
   - Verify `try_files` directive exists

3. **Test URLs:**
   - Homepage: `https://websekolah.gdvmedia.my.id/`
   - Admin: `https://websekolah.gdvmedia.my.id/admin`
   - Login: `https://websekolah.gdvmedia.my.id/admin/login`

### Common Issues & Solutions

#### Issue: 404 Not Found
**Cause:** Document root not pointing to `public` folder
**Solution:** 
1. Go to aaPanel → Website → Site Directory
2. Set Running Directory to `/public`
3. Restart Nginx

#### Issue: "No input file specified"
**Cause:** Incorrect fastcgi_param in nginx config
**Solution:**
Ensure this line exists in PHP location block:
```nginx
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
```

#### Issue: CSS/JS not loading
**Cause:** Incorrect BASE_URL
**Solution:**
In `config/config.php`, BASE_URL should be:
```php
define('BASE_URL', 'https://websekolah.gdvmedia.my.id/');
// NOT: 'https://websekolah.gdvmedia.my.id/public/'
```

#### Issue: Admin page not accessible
**Cause:** URL rewrite not working
**Solution:**
Add this to nginx config:
```nginx
location / {
    try_files $uri $uri/ /index.php?url=$uri&$args;
}
```

### Security Checklist for Production

- [x] Document root points to `/public` folder
- [x] Change default admin password (admin/admin123)
- [x] Enable SSL/HTTPS in aaPanel
- [x] Set proper file permissions (755/644)
- [x] Configure firewall rules
- [x] Enable regular backups in aaPanel
- [x] Set ENVIRONMENT to 'production' in config.php
- [x] Test all URLs and functionality

### aaPanel-Specific Settings

#### PHP Settings
Go to aaPanel → Software Store → PHP 7.4 → Settings:

1. **Install Extensions:**
   - mysqli
   - pdo_mysql
   - gd
   - mbstring
   - openssl

2. **Adjust php.ini:**
   ```ini
   upload_max_filesize = 10M
   post_max_size = 10M
   max_execution_time = 300
   memory_limit = 256M
   ```

#### SSL Configuration
1. Go to aaPanel → Website → Your Site → SSL
2. Choose Let's Encrypt or upload your certificate
3. Enable **Force HTTPS**

### First Login

```
URL: https://websekolah.gdvmedia.my.id/admin/login
Username: admin
Password: admin123
```

**IMPORTANT:** Change the password immediately after first login!

---

## Troubleshooting Command Line

```bash
# Check nginx configuration
nginx -t

# Restart nginx (via aaPanel is preferred)
systemctl restart nginx

# Check PHP-FPM
systemctl status php-fpm-74

# View nginx error log
tail -f /www/wwwlogs/websekolah.gdvmedia.my.id.error.log

# View access log
tail -f /www/wwwlogs/websekolah.gdvmedia.my.id.log

# Check file permissions
ls -la /www/wwwroot/websekolah.gdvmedia.my.id/public/
```

---

## Quick Configuration Summary

| Setting | Value |
|---------|-------|
| Document Root | `/www/wwwroot/websekolah.gdvmedia.my.id/public` |
| Running Directory | `/public` |
| BASE_URL | `https://websekolah.gdvmedia.my.id/` |
| PHP Version | 7.4+ |
| Required Extensions | mysqli, pdo_mysql, gd, mbstring |

---

**Last Updated:** 2026-01-05
**Version:** 1.1.0 - Nginx/aaPanel Edition

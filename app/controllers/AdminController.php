<?php

class AdminController extends Controller
{
    public function __construct()
    {
        // Skip login check for login page
        if ($_SERVER['REQUEST_URI'] !== '/web-sekolah/public/admin/login' && 
            !strpos($_SERVER['REQUEST_URI'], 'admin/login')) {
            $this->requireLogin();
        }
    }

    public function index()
    {
        $settingModel = $this->model('Setting');
        $newsModel = $this->model('News');
        $teacherModel = $this->model('Teacher');
        $studentModel = $this->model('Student');
        
        $data = [
            'title' => 'Dashboard Admin',
            'settings' => $settingModel->get(),
            'totalNews' => count($newsModel->getAll()),
            'totalTeachers' => count($teacherModel->getAll()),
            'studentStats' => $studentModel->getCurrent()
        ];
        
        $this->view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $adminModel = $this->model('Admin');
            $admin = $adminModel->login($username, $password);
            
            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];
                
                header('Location: ' . BASE_URL . 'admin');
                exit;
            } else {
                $data = [
                    'title' => 'Login Admin',
                    'error' => 'Username atau password salah'
                ];
                $this->view('admin/login', $data);
            }
        } else {
            $data = ['title' => 'Login Admin'];
            $this->view('admin/login', $data);
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'admin/login');
        exit;
    }

    // Settings Management
    public function settings()
    {
        $settingModel = $this->model('Setting');
        $data = [
            'title' => 'Pengaturan Sekolah',
            'settings' => $settingModel->get()
        ];
        
        $this->view('admin/settings', $data);
    }

    public function updateSettings()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settingModel = $this->model('Setting');
            $currentSettings = $settingModel->get();
            
            $logo = $currentSettings['logo'];
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $uploadedLogo = $this->model('Model')->uploadFile($_FILES['logo'], 'images/settings/');
                if ($uploadedLogo) {
                    if ($logo) $this->model('Model')->deleteFile($logo);
                    $logo = $uploadedLogo;
                }
            }
            
            $data = [
                'id' => $currentSettings['id'],
                'school_name' => $_POST['school_name'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'website' => $_POST['website'],
                'logo' => $logo
            ];
            
            if ($settingModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Pengaturan berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update pengaturan'], 500);
            }
        }
    }

    // Slider Management
    public function slider()
    {
        $sliderModel = $this->model('Slider');
        $data = [
            'title' => 'Manajemen Slider',
            'sliders' => $sliderModel->getAll()
        ];
        
        $this->view('admin/slider', $data);
    }

    public function getSlider($id)
    {
        $sliderModel = $this->model('Slider');
        $slider = $sliderModel->getById($id);
        $this->jsonResponse($slider);
    }

    public function createSlider()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $this->model('Model')->uploadFile($_FILES['image'], 'images/slider/');
            }
            
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'image' => $image,
                'sort_order' => $_POST['sort_order'] ?? 0,
                'is_active' => $_POST['is_active'] ?? 1
            ];
            
            $sliderModel = $this->model('Slider');
            if ($sliderModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Slider berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan slider'], 500);
            }
        }
    }

    public function updateSlider()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sliderModel = $this->model('Slider');
            $currentSlider = $sliderModel->getById($_POST['id']);
            
            $image = $currentSlider['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadedImage = $this->model('Model')->uploadFile($_FILES['image'], 'images/slider/');
                if ($uploadedImage) {
                    if ($image) $this->model('Model')->deleteFile($image);
                    $image = $uploadedImage;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'image' => $image,
                'sort_order' => $_POST['sort_order'] ?? 0,
                'is_active' => $_POST['is_active'] ?? 1
            ];
            
            if ($sliderModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Slider berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update slider'], 500);
            }
        }
    }

    public function deleteSlider($id)
    {
        $sliderModel = $this->model('Slider');
        $slider = $sliderModel->getById($id);
        
        if ($slider && $slider['image']) {
            $this->model('Model')->deleteFile($slider['image']);
        }
        
        if ($sliderModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Slider berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus slider'], 500);
        }
    }

    // News Management
    public function news()
    {
        $newsModel = $this->model('News');
        $data = [
            'title' => 'Manajemen Berita',
            'newsList' => $newsModel->getAll()
        ];
        
        $this->view('admin/news', $data);
    }

    public function getNews($id)
    {
        $newsModel = $this->model('News');
        $news = $newsModel->getById($id);
        $this->jsonResponse($news);
    }

    public function createNews()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $this->model('Model')->uploadFile($_FILES['image'], 'images/news/');
            }
            
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $image,
                'author' => $_SESSION['admin_name'],
                'publish_date' => $_POST['publish_date'],
                'is_published' => $_POST['is_published'] ?? 1
            ];
            
            $newsModel = $this->model('News');
            if ($newsModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Berita berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan berita'], 500);
            }
        }
    }

    public function updateNews()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsModel = $this->model('News');
            $currentNews = $newsModel->getById($_POST['id']);
            
            $image = $currentNews['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadedImage = $this->model('Model')->uploadFile($_FILES['image'], 'images/news/');
                if ($uploadedImage) {
                    if ($image) $this->model('Model')->deleteFile($image);
                    $image = $uploadedImage;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $image,
                'author' => $_POST['author'],
                'publish_date' => $_POST['publish_date'],
                'is_published' => $_POST['is_published'] ?? 1
            ];
            
            if ($newsModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Berita berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update berita'], 500);
            }
        }
    }

    public function deleteNews($id)
    {
        $newsModel = $this->model('News');
        $news = $newsModel->getById($id);
        
        if ($news && $news['image']) {
            $this->model('Model')->deleteFile($news['image']);
        }
        
        if ($newsModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Berita berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus berita'], 500);
        }
    }

    // Teachers Management
    public function teachers()
    {
        $teacherModel = $this->model('Teacher');
        $data = [
            'title' => 'Manajemen Guru',
            'teachers' => $teacherModel->getAll()
        ];
        
        $this->view('admin/teachers', $data);
    }

    public function getTeacher($id)
    {
        $teacherModel = $this->model('Teacher');
        $teacher = $teacherModel->getById($id);
        $this->jsonResponse($teacher);
    }

    public function createTeacher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photo = '';
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photo = $this->model('Model')->uploadFile($_FILES['photo'], 'images/teachers/');
            }
            
            $data = [
                'photo' => $photo,
                'name' => $_POST['name'],
                'subject' => $_POST['subject'],
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            $teacherModel = $this->model('Teacher');
            if ($teacherModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Guru berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan guru'], 500);
            }
        }
    }

    public function updateTeacher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teacherModel = $this->model('Teacher');
            $currentTeacher = $teacherModel->getById($_POST['id']);
            
            $photo = $currentTeacher['photo'];
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadedPhoto = $this->model('Model')->uploadFile($_FILES['photo'], 'images/teachers/');
                if ($uploadedPhoto) {
                    if ($photo) $this->model('Model')->deleteFile($photo);
                    $photo = $uploadedPhoto;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'photo' => $photo,
                'name' => $_POST['name'],
                'subject' => $_POST['subject'],
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            if ($teacherModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Data guru berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update data guru'], 500);
            }
        }
    }

    public function deleteTeacher($id)
    {
        $teacherModel = $this->model('Teacher');
        $teacher = $teacherModel->getById($id);
        
        if ($teacher && $teacher['photo']) {
            $this->model('Model')->deleteFile($teacher['photo']);
        }
        
        if ($teacherModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Guru berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus guru'], 500);
        }
    }

    // Students Management
    public function students()
    {
        $studentModel = $this->model('Student');
        $data = [
            'title' => 'Manajemen Siswa',
            'studentStats' => $studentModel->getCurrent()
        ];
        
        $this->view('admin/students', $data);
    }

    public function updateStudents()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentModel = $this->model('Student');
            $currentStats = $studentModel->getCurrent();
            
            $data = [
                'id' => $currentStats['id'],
                'total_students' => $_POST['total_students'],
                'male_students' => $_POST['male_students'],
                'female_students' => $_POST['female_students']
            ];
            
            if ($studentModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Data siswa berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update data siswa'], 500);
            }
        }
    }

    // Profile Management
    public function profile()
    {
        $profileModel = $this->model('Profile');
        $data = [
            'title' => 'Manajemen Profil Sekolah',
            'profile' => $profileModel->get()
        ];
        
        $this->view('admin/profile', $data);
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profileModel = $this->model('Profile');
            $currentProfile = $profileModel->get();
            
            $orgStructure = $currentProfile['organizational_structure'];
            if (isset($_FILES['organizational_structure']) && $_FILES['organizational_structure']['error'] === UPLOAD_ERR_OK) {
                $uploaded = $this->model('Model')->uploadFile($_FILES['organizational_structure'], 'images/profile/');
                if ($uploaded) {
                    if ($orgStructure) $this->model('Model')->deleteFile($orgStructure);
                    $orgStructure = $uploaded;
                }
            }
            
            $data = [
                'id' => $currentProfile['id'],
                'vision' => $_POST['vision'],
                'mission' => $_POST['mission'],
                'history' => $_POST['history'],
                'organizational_structure' => $orgStructure,
                'advantages' => $_POST['advantages']
            ];
            
            if ($profileModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Profil sekolah berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update profil sekolah'], 500);
            }
        }
    }

    // Gallery Photos Management
    public function galleryPhotos()
    {
        $galleryModel = $this->model('Gallery');
        $data = [
            'title' => 'Manajemen Galeri Foto',
            'photos' => $galleryModel->getAllPhotos()
        ];
        
        $this->view('admin/gallery_photos', $data);
    }

    public function getPhoto($id)
    {
        $galleryModel = $this->model('Gallery');
        $photo = $galleryModel->getPhotoById($id);
        $this->jsonResponse($photo);
    }

    public function createPhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $this->model('Model')->uploadFile($_FILES['image'], 'images/gallery/');
            }
            
            $data = [
                'title' => $_POST['title'],
                'image' => $image,
                'category' => $_POST['category'] ?? '',
                'caption' => $_POST['caption'] ?? ''
            ];
            
            $galleryModel = $this->model('Gallery');
            if ($galleryModel->createPhoto($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Foto berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan foto'], 500);
            }
        }
    }

    public function updatePhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galleryModel = $this->model('Gallery');
            $currentPhoto = $galleryModel->getPhotoById($_POST['id']);
            
            $image = $currentPhoto['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadedImage = $this->model('Model')->uploadFile($_FILES['image'], 'images/gallery/');
                if ($uploadedImage) {
                    if ($image) $this->model('Model')->deleteFile($image);
                    $image = $uploadedImage;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'image' => $image,
                'category' => $_POST['category'] ?? '',
                'caption' => $_POST['caption'] ?? ''
            ];
            
            if ($galleryModel->updatePhoto($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Foto berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update foto'], 500);
            }
        }
    }

    public function deletePhoto($id)
    {
        $galleryModel = $this->model('Gallery');
        $photo = $galleryModel->getPhotoById($id);
        
        if ($photo && $photo['image']) {
            $this->model('Model')->deleteFile($photo['image']);
        }
        
        if ($galleryModel->deletePhoto($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Foto berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus foto'], 500);
        }
    }

    // Gallery Videos Management
    public function galleryVideos()
    {
        $galleryModel = $this->model('Gallery');
        $data = [
            'title' => 'Manajemen Galeri Video',
            'videos' => $galleryModel->getAllVideos()
        ];
        
        $this->view('admin/gallery_videos', $data);
    }

    public function getVideo($id)
    {
        $galleryModel = $this->model('Gallery');
        $video = $galleryModel->getVideoById($id);
        $this->jsonResponse($video);
    }

    public function createVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $thumbnail = '';
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $thumbnail = $this->model('Model')->uploadFile($_FILES['thumbnail'], 'images/video_thumbnails/');
            }
            
            $data = [
                'title' => $_POST['title'],
                'video_url' => $_POST['video_url'],
                'thumbnail' => $thumbnail,
                'description' => $_POST['description'] ?? ''
            ];
            
            $galleryModel = $this->model('Gallery');
            if ($galleryModel->createVideo($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Video berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan video'], 500);
            }
        }
    }

    public function updateVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galleryModel = $this->model('Gallery');
            $currentVideo = $galleryModel->getVideoById($_POST['id']);
            
            $thumbnail = $currentVideo['thumbnail'];
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $uploadedThumbnail = $this->model('Model')->uploadFile($_FILES['thumbnail'], 'images/video_thumbnails/');
                if ($uploadedThumbnail) {
                    if ($thumbnail) $this->model('Model')->deleteFile($thumbnail);
                    $thumbnail = $uploadedThumbnail;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'video_url' => $_POST['video_url'],
                'thumbnail' => $thumbnail,
                'description' => $_POST['description'] ?? ''
            ];
            
            if ($galleryModel->updateVideo($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Video berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update video'], 500);
            }
        }
    }

    public function deleteVideo($id)
    {
        $galleryModel = $this->model('Gallery');
        $video = $galleryModel->getVideoById($id);
        
        if ($video && $video['thumbnail']) {
            $this->model('Model')->deleteFile($video['thumbnail']);
        }
        
        if ($galleryModel->deleteVideo($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Video berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus video'], 500);
        }
    }

    // Achievements Management
    public function achievements()
    {
        $achievementModel = $this->model('Achievement');
        $data = [
            'title' => 'Manajemen Prestasi',
            'achievements' => $achievementModel->getAll()
        ];
        
        $this->view('admin/achievements', $data);
    }

    public function getAchievement($id)
    {
        $achievementModel = $this->model('Achievement');
        $achievement = $achievementModel->getById($id);
        $this->jsonResponse($achievement);
    }

    public function createAchievement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $this->model('Model')->uploadFile($_FILES['image'], 'images/achievements/');
            }
            
            $data = [
                'type' => $_POST['type'],
                'title' => $_POST['title'],
                'description' => $_POST['description'] ?? '',
                'year' => $_POST['year'],
                'image' => $image
            ];
            
            $achievementModel = $this->model('Achievement');
            if ($achievementModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Prestasi berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan prestasi'], 500);
            }
        }
    }

    public function updateAchievement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $achievementModel = $this->model('Achievement');
            $currentAchievement = $achievementModel->getById($_POST['id']);
            
            $image = $currentAchievement['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadedImage = $this->model('Model')->uploadFile($_FILES['image'], 'images/achievements/');
                if ($uploadedImage) {
                    if ($image) $this->model('Model')->deleteFile($image);
                    $image = $uploadedImage;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'type' => $_POST['type'],
                'title' => $_POST['title'],
                'description' => $_POST['description'] ?? '',
                'year' => $_POST['year'],
                'image' => $image
            ];
            
            if ($achievementModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Prestasi berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update prestasi'], 500);
            }
        }
    }

    public function deleteAchievement($id)
    {
        $achievementModel = $this->model('Achievement');
        $achievement = $achievementModel->getById($id);
        
        if ($achievement && $achievement['image']) {
            $this->model('Model')->deleteFile($achievement['image']);
        }
        
        if ($achievementModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Prestasi berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus prestasi'], 500);
        }
    }

    // Downloads Management
    public function downloads()
    {
        $downloadModel = $this->model('Download');
        $data = [
            'title' => 'Manajemen Download',
            'downloads' => $downloadModel->getAll()
        ];
        
        $this->view('admin/downloads', $data);
    }

    public function getDownload($id)
    {
        $downloadModel = $this->model('Download');
        $download = $downloadModel->getById($id);
        $this->jsonResponse($download);
    }

    public function createDownload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = '';
            $fileType = '';
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar'];
                $uploaded = $this->model('Model')->uploadFile($_FILES['file'], 'files/downloads/', $allowedTypes);
                if ($uploaded) {
                    $file = $uploaded;
                    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                }
            }
            
            $data = [
                'title' => $_POST['title'],
                'file_path' => $file,
                'file_type' => $fileType,
                'category' => $_POST['category'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];
            
            $downloadModel = $this->model('Download');
            if ($downloadModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'File berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan file'], 500);
            }
        }
    }

    public function updateDownload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $downloadModel = $this->model('Download');
            $currentDownload = $downloadModel->getById($_POST['id']);
            
            $file = $currentDownload['file_path'];
            $fileType = $currentDownload['file_type'];
            
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar'];
                $uploaded = $this->model('Model')->uploadFile($_FILES['file'], 'files/downloads/', $allowedTypes);
                if ($uploaded) {
                    if ($file) $this->model('Model')->deleteFile($file);
                    $file = $uploaded;
                    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'file_path' => $file,
                'file_type' => $fileType,
                'category' => $_POST['category'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];
            
            if ($downloadModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'File berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update file'], 500);
            }
        }
    }

    public function deleteDownload($id)
    {
        $downloadModel = $this->model('Download');
        $download = $downloadModel->getById($id);
        
        if ($download && $download['file_path']) {
            $this->model('Model')->deleteFile($download['file_path']);
        }
        
        if ($downloadModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'File berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus file'], 500);
        }
    }

    // App Links Management
    public function appLinks()
    {
        $appLinkModel = $this->model('AppLink');
        $data = [
            'title' => 'Manajemen Link Aplikasi',
            'appLinks' => $appLinkModel->getAll()
        ];
        
        $this->view('admin/app_links', $data);
    }

    public function getAppLink($id)
    {
        $appLinkModel = $this->model('AppLink');
        $appLink = $appLinkModel->getById($id);
        $this->jsonResponse($appLink);
    }

    public function createAppLink()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $icon = '';
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $icon = $this->model('Model')->uploadFile($_FILES['icon'], 'images/icons/');
            }
            
            $data = [
                'name' => $_POST['name'],
                'url' => $_POST['url'],
                'icon' => $icon,
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            $appLinkModel = $this->model('AppLink');
            if ($appLinkModel->create($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Link aplikasi berhasil ditambahkan']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan link aplikasi'], 500);
            }
        }
    }

    public function updateAppLink()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appLinkModel = $this->model('AppLink');
            $currentAppLink = $appLinkModel->getById($_POST['id']);
            
            $icon = $currentAppLink['icon'];
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $uploadedIcon = $this->model('Model')->uploadFile($_FILES['icon'], 'images/icons/');
                if ($uploadedIcon) {
                    if ($icon) $this->model('Model')->deleteFile($icon);
                    $icon = $uploadedIcon;
                }
            }
            
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'url' => $_POST['url'],
                'icon' => $icon,
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            if ($appLinkModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Link aplikasi berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update link aplikasi'], 500);
            }
        }
    }

    public function deleteAppLink($id)
    {
        $appLinkModel = $this->model('AppLink');
        $appLink = $appLinkModel->getById($id);
        
        if ($appLink && $appLink['icon']) {
            $this->model('Model')->deleteFile($appLink['icon']);
        }
        
        if ($appLinkModel->delete($id)) {
            $this->jsonResponse(['success' => true, 'message' => 'Link aplikasi berhasil dihapus']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menghapus link aplikasi'], 500);
        }
    }

    // Contact Management
    public function contact()
    {
        $contactModel = $this->model('Contact');
        $data = [
            'title' => 'Manajemen Kontak',
            'contact' => $contactModel->get()
        ];
        
        $this->view('admin/contact', $data);
    }

    public function updateContact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = $this->model('Contact');
            $currentContact = $contactModel->get();
            
            $data = [
                'id' => $currentContact['id'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'whatsapp' => $_POST['whatsapp'],
                'facebook' => $_POST['facebook'] ?? '',
                'instagram' => $_POST['instagram'] ?? '',
                'twitter' => $_POST['twitter'] ?? '',
                'youtube' => $_POST['youtube'] ?? '',
                'maps_embed' => $_POST['maps_embed'] ?? ''
            ];
            
            if ($contactModel->update($data)) {
                $this->jsonResponse(['success' => true, 'message' => 'Kontak berhasil diupdate']);
            } else {
                $this->jsonResponse(['success' => false, 'message' => 'Gagal update kontak'], 500);
            }
        }
    }
}

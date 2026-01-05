<?php

class HomeController extends Controller
{
    public function index()
    {
        $settingModel = $this->model('Setting');
        $sliderModel = $this->model('Slider');
        $newsModel = $this->model('News');
        $teacherModel = $this->model('Teacher');
        $studentModel = $this->model('Student');
        $contactModel = $this->model('Contact');
        
        $data = [
            'title' => 'Dashboard',
            'settings' => $settingModel->get(),
            'sliders' => $sliderModel->getActive(),
            'latestNews' => $newsModel->getPublished(3),
            'teachers' => $teacherModel->getAll(),
            'studentStats' => $studentModel->getCurrent(),
            'contact' => $contactModel->get()
        ];
        
        $this->view('home/index', $data);
    }

    public function profil($page = 'visi-misi')
    {
        $settingModel = $this->model('Setting');
        $profileModel = $this->model('Profile');
        
        $data = [
            'title' => 'Profil Sekolah',
            'page' => $page,
            'settings' => $settingModel->get(),
            'profile' => $profileModel->get()
        ];
        
        $this->view('home/profil', $data);
    }

    public function berita($slug = null)
    {
        $settingModel = $this->model('Setting');
        $newsModel = $this->model('News');
        
        if ($slug) {
            $news = $newsModel->getBySlug($slug);
            if (!$news) {
                header('Location: ' . BASE_URL . 'home/berita');
                exit;
            }
            
            $data = [
                'title' => $news['title'],
                'settings' => $settingModel->get(),
                'news' => $news,
                'latestNews' => $newsModel->getPublished(5)
            ];
            
            $this->view('home/berita_detail', $data);
        } else {
            $data = [
                'title' => 'Berita Sekolah',
                'settings' => $settingModel->get(),
                'newsList' => $newsModel->getPublished()
            ];
            
            $this->view('home/berita', $data);
        }
    }

    public function galeri($type = 'foto')
    {
        $settingModel = $this->model('Setting');
        $galleryModel = $this->model('Gallery');
        
        $data = [
            'title' => 'Galeri',
            'type' => $type,
            'settings' => $settingModel->get()
        ];
        
        if ($type === 'video') {
            $data['videos'] = $galleryModel->getAllVideos();
        } else {
            $data['photos'] = $galleryModel->getAllPhotos();
        }
        
        $this->view('home/galeri', $data);
    }

    public function prestasi($type = 'all')
    {
        $settingModel = $this->model('Setting');
        $achievementModel = $this->model('Achievement');
        
        $data = [
            'title' => 'Prestasi',
            'type' => $type,
            'settings' => $settingModel->get()
        ];
        
        if ($type === 'all') {
            $data['achievements'] = $achievementModel->getAll();
        } else {
            $data['achievements'] = $achievementModel->getByType($type);
        }
        
        $this->view('home/prestasi', $data);
    }

    public function download()
    {
        $settingModel = $this->model('Setting');
        $downloadModel = $this->model('Download');
        
        $data = [
            'title' => 'Download',
            'settings' => $settingModel->get(),
            'downloads' => $downloadModel->getAll()
        ];
        
        $this->view('home/download', $data);
    }

    public function downloadFile($id)
    {
        $downloadModel = $this->model('Download');
        $file = $downloadModel->getById($id);
        
        if ($file) {
            $downloadModel->incrementDownloadCount($id);
            $filePath = '../public/' . $file['file_path'];
            
            if (file_exists($filePath)) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                header('Content-Length: ' . filesize($filePath));
                readfile($filePath);
                exit;
            }
        }
        
        header('Location: ' . BASE_URL . 'home/download');
        exit;
    }

    public function aplikasi()
    {
        $settingModel = $this->model('Setting');
        $appLinkModel = $this->model('AppLink');
        
        $data = [
            'title' => 'Link Aplikasi',
            'settings' => $settingModel->get(),
            'appLinks' => $appLinkModel->getAll()
        ];
        
        $this->view('home/aplikasi', $data);
    }

    public function kontak()
    {
        $settingModel = $this->model('Setting');
        $contactModel = $this->model('Contact');
        
        $data = [
            'title' => 'Kontak',
            'settings' => $settingModel->get(),
            'contact' => $contactModel->get()
        ];
        
        $this->view('home/kontak', $data);
    }
}

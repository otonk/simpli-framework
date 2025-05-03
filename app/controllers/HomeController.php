<?php

class HomeController extends Controller {

    /**
     * Menampilkan halaman utama.
     */
    public function index() {
        // Data untuk dikirim ke view
        $data = [
            'title' => 'Simpli Framework v1.1', // Contoh update title
            'message' => 'Selamat Datang di Simpli Framework!',
            'submessage' => 'a simple PHP framework'
        ];

        // Panggil method view dari Controller base class
        // Menggunakan layout default 'main'
        $this->view('home/index', $data);
    }

    /**
     * Contoh method lain dengan parameter dari URL.
     * Akses via /home/user/JohnDoe
     */
    public function user($name = 'Guest') {
         $data = [
            'title' => 'User Profile',
            'userName' => $name // Nama dari URL
         ];
         // Anda mungkin perlu membuat view 'home/user.php'
         // $this->view('home/user', $data);
         echo "Hello, " . e($name) . "!"; // Contoh output langsung
    }
}

?>
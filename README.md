![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-purple)
![Database](https://img.shields.io/badge/SQLite-3.x-green)

# 🔥 Simpli Framework  

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Release](https://img.shields.io/github/v/release/otonk/simpli-framework)](https://github.com/oyonk/simpli-framework/releases)

Framework PHP native sederhana berbasis MVC untuk project kecil-menengah.  

## 🌟 Fitur
- ✅ Struktur MVC clean
- ✅ Routing otomatis
- ✅ SQLite support
- ✅ Error handling (404/500)
- ✅ Helper functions

## 🚀 Instalasi
1. Clone repo:
   ```bash
   git clone https://github.com/otonk/simpli-framework.git
   ```
2. Atur BASEURL di `config.php`:
   ```php
   define('BASEURL', 'http://localhost/simpli/public');
   ```
3. Akses via browser:
   ```
   http://localhost/simpli/public
   ```

## 📂 Struktur Project
```
/simpli
├── app/          # Core MVC
├── public/       # Entry point
├── database/     # SQLite files
└── config/       # Konfigurasi
```

## 💻 Contoh Penggunaan
```php
// Contoh Controller
class HomeController extends Controller {
    public function index() {
        $this->view('home/index', ['title' => 'Home']);
    }
}
```

## 🤝 Kontribusi
Pull requests welcome!  

---
🔥 **Dibuat dengan ❤️ dan Bismillah
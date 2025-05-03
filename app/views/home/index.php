<?php
// Konten spesifik untuk halaman home (akan dimasukkan ke dalam layout)
// Variabel $data tersedia dari Controller
?>

<div class="content">
    <p style="margin-top: 2rem; font-size: 1rem; color: #555;">
        Anda berada di halaman utama (`home/index`).
    </p>
    <p style="font-size: 0.9rem;">
        Coba akses <a href="<?= BASEURL ?>/home/user/NamaAnda">/home/user/NamaAnda</a>
        atau <a href="<?= BASEURL ?>/nonexistentpage">halaman yang tidak ada</a> untuk melihat error 404.
    </p>

    </div>
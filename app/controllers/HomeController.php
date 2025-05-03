<?php
require_once '../app/core/Controller.php';

class HomeController extends Controller {
public function index() {
    $data = [
        'title' => 'Simpli Framework',
        'message' => 'Anda menggunakan Simpli Framework 1.0',
        'submessage' => 'A Simple PHP framework'
    ];
    $this->view('home/index', $data);
}
}
<?php
class Controller {
    public function view($view, $data = []) {
        require_once '../app/views/layouts/main.php';
    }
}

protected function sanitize($input) {
    if (is_array($input)) {
        return array_map([$this, 'sanitize'], $input);
    }
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
}
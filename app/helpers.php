function asset($path) {
    return BASEURL . '/assets/' . ltrim($path, '/');
}

function redirect($url) {
    header("Location: " . BASEURL . "/" . ltrim($url, '/'));
    exit;
}
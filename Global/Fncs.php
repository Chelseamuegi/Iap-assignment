<?php
class Fncs {
    public function setMsg($key, $value, $type = 'info') {
        $_SESSION[$key] = [
            'text' => $value,
            'type' => $type
        ];
    }

    public function getMsg($key) {
        if (!empty($_SESSION[$key])) {
            $msg = $_SESSION[$key];
            unset($_SESSION[$key]);
            return "<p class='{$msg['type']}'>{$msg['text']}</p>";
        }
        return '';
    }
}
?>

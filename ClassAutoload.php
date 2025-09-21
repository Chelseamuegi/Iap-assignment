<?php
require 'conf.php';

// Folders that contain your classes
$directories = ['Layouts', 'Forms', 'Global', 'Proc'];

// Autoload classes from those folders
spl_autoload_register(function ($class_name) use ($directories) {
    foreach ($directories as $directory) {
        $file = __DIR__ . '/' . $directory . '/' . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Create instances of your classes
$ObjSendMail = new SendMail();
$ObjLayout   = new Layouts();
$ObjForm     = new Forms();

$ObjAuth = new Auth();   // Class name should match the file/class exactly (capitalized "A")
$ObjFncs = new Fncs();

// Call signup method (handles form submission for library users)
$ObjAuth->signup($conf, $ObjFncs);

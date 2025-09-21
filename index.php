<?php
require 'ClassAutoLoad.php';

// Render the page layout
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->banner($conf);
$ObjLayout->content($conf);
$ObjLayout->footer($conf);

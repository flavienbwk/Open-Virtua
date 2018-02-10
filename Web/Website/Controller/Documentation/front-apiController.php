<?php

/* 
 * Direct Framework, under MIT license.
 */

// Autoloader automatically includes the Page class.
$Page = new Page();
$Page->setTitle("Front-end API - ", true);

/*
 * Views
 */
require($Page->renderURI("View/Index/headerView.php"));
require($Page->renderURI("View/Documentation/front-apiView.php"));
require($Page->renderURI("View/Index/footerView.php"));

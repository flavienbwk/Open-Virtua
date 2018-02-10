<?php

/* 
 * Direct Framework, under MIT license.
 */

// Autoloader automatically includes the Page class.
$Page = new Page();
$Page->setTitle("Home - ", true);

/*
 * Views
 */
require($Page->renderURI("View/Index/headerView.php"));
require($Page->renderURI("View/Index/indexView.php"));
require($Page->renderURI("View/Index/footerView.php"));
<?php

/* 
 * Direct Framework, under MIT license.
 */

// Autoloader automatically includes the Page class.
$Page = new Page();
$Page->setTitle("The API - ", true);

/*
 * Views
 */
require($Page->renderURI("View/Index/headerView.php"));
require($Page->renderURI("View/Documentation/apiView.php"));
require($Page->renderURI("View/Index/footerView.php"));

<?php

/*
 * Direct Framework, under MIT license.
 */

// Autoloader automatically includes the Page class.
$Page = new Page();
$Page->setTitle("Getting started - ", true);

/*
 * Views
 */
require($Page->renderURI("View/Index/headerView.php"));
require($Page->renderURI("View/Documentation/getting-startedView.php"));
require($Page->renderURI("View/Index/footerView.php"));


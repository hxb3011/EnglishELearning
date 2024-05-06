<?php
require_once("/var/www/html/_lib/utils/requir.php");
// requirc("/administration/index.php");
requirv("checkout.php");
global $page;
$page = new CheckoutPage();
requira("_layout.php");

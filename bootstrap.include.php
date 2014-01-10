<?php

/**
 * Library
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://kit2.phpmanufaktur.de
 * @copyright 2014 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

$app->get('/admin/library/setup',
    'phpManufaktur\Library\Setup\Setup::ControllerSetup');
$app->get('/admin/library/update',
    'phpManufaktur\Library\Setup\Update::ControllerUpdate');

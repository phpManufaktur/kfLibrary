<?php

/**
 * Library
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://kit2.phpmanufaktur.de
 * @copyright 2014 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

namespace phpManufaktur\Library\Setup;

use Silex\Application;

class Setup
{
    protected $app = null;

    /**
     * Create the symbolic links for the different libraries and extensions
     *
     * @param Application $app
     */
    public function createSymlinks(Application $app)
    {
        // create symlinks for the LIBRARY directories

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/bootstrap/3.0.3',
            MANUFAKTUR_PATH.'/Library/Library/bootstrap/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/font-awesome/4.0.3',
            MANUFAKTUR_PATH.'/Library/Library/font-awesome/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/jquery/jquery/2.0.3',
            MANUFAKTUR_PATH.'/Library/Library/jquery/jquery/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/jquery/migrate/1.2.1',
            MANUFAKTUR_PATH.'/Library/Library/jquery/migrate/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/jquery/tagedit/1.5.1',
            MANUFAKTUR_PATH.'/Library/Library/jquery/tagedit/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/jquery/timepicker/1.4.3',
            MANUFAKTUR_PATH.'/Library/Library/jquery/timepicker/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Library/jquery/ui/1.10.3',
            MANUFAKTUR_PATH.'/Library/Library/jquery/ui/latest');

        // create symlinks for the EXTENSION directories

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Extension/htmlpurifier/4.6.0',
            MANUFAKTUR_PATH.'/Library/Extension/htmlpurifier/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Extension/carbon/1.8.0',
            MANUFAKTUR_PATH.'/Library/Extension/carbon/latest');

        $app['filesystem']->symlink(
            MANUFAKTUR_PATH.'/Library/Extension/dflydev/markdown/1.0.3',
            MANUFAKTUR_PATH.'/Library/Extension/dflydev/markdown/latest');

    }

    /**
     * Controller to execute the setup process for the Library
     *
     * @param Application $app
     */
    public function ControllerSetup(Application $app)
    {
        $this->app = $app;

        $this->createSymlinks($app);

        return $app['translator']->trans('Successfull configured the kitFramework Library.');
    }
}

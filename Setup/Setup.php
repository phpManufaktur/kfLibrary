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

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/bootstrap')) {
            $app['filesystem']->symlink('3.0.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/bootstrap');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/bootstrap');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/font-awesome')) {
            $app['filesystem']->symlink('4.0.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/font-awesome');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/font-awesome');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/jquery/jquery')) {
            $app['filesystem']->symlink('2.0.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/jquery/jquery/2.0.3');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/jquery/jquery/2.0.3');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/jquery/migrate')) {
            $app['filesystem']->symlink('1.2.1', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/jquery/migrate/1.2.1');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/jquery/migrate/1.2.1');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/jquery/tagedit')) {
            $app['filesystem']->symlink('1.5.1', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/jquery/tagedit/1.5.1');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/jquery/tagedit/1.5.1');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/jquery/timepicker')) {
            $app['filesystem']->symlink('1.4.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/jquery/timepicker/1.4.3');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/jquery/timepicker/1.4.3');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Library/jquery/ui')) {
            $app['filesystem']->symlink('1.10.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Library/jquery/ui/1.10.3');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Library/jquery/ui/1.10.3');
        }

        // create symlinks for the EXTENSION directories

        if (chdir(MANUFAKTUR_PATH.'/Library/Extension/htmlpurifier')) {
            $app['filesystem']->symlink('4.6.0', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Extension/htmlpurifier/4.6.0');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Extension/htmlpurifier/4.6.0');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Extension/carbon')) {
            $app['filesystem']->symlink('1.8.0', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Extension/carbon/1.8.0');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Extension/carbon/1.8.0');
        }

        if (chdir(MANUFAKTUR_PATH.'/Library/Extension/dflydev/markdown')) {
            $app['filesystem']->symlink('1.0.3', 'latest');
            $app['monolog']->addDebug('Created SymLink in /Library/Extension/dflydev/markdown/1.0.3');
        }
        else {
            $app['monolog']->addDebug('Failed to create SymLink in /Library/Extension/dflydev/markdown/1.0.3');
        }

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

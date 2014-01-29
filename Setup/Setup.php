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
     * Controller to execute the setup process for the Library
     *
     * @param Application $app
     */
    public function ControllerSetup(Application $app)
    {
        $this->app = $app;

        return $app['translator']->trans('Successfull configured the kitFramework Library.');
    }
}

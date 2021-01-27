<?php
/**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2019-11-06
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.6 - 1.7
 */

namespace mdg\homecategorypush\core\Controllers;

class ModuleFrontController extends \ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign([
            'module_dir' => __PS_BASE_URI__ . "modules/{$this->module->name}/",
        ]);
    }

}

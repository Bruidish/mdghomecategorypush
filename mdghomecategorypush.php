<?php
/**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2019-10-07
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.7
 */

require_once __DIR__ . '/vendor/autoload.php';

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class mdghomecategorypush extends \Module implements WidgetInterface
{
    use mdg\homecategorypush\Traits\HookTrait;
    use mdg\homecategorypush\Traits\WidgetTrait;

    public function __construct()
    {
        $this->name = 'mdghomecategorypush';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Michel Dumont';
        $this->need_instance = 0;
        $this->bootstrap = 1;
        $this->ps_versions_compliancy = ['min' => '1.7.6.0', 'max' => _PS_VERSION_];
        $this->ps_versions_dir = version_compare(_PS_VERSION_, '1.7', '<') ? 'v16' : 'v17';

        foreach (glob(_PS_MODULE_DIR_ . "{$this->name}/controllers/front/*.php") as $file) {
            $fileName = basename($file, '.php');
            if ($fileName !== 'index') {
                $this->controllers[] = $fileName;
            }
        }

        parent::__construct();

        $this->displayName = $this->l('(mdg) Home category push');
        $this->description = $this->l('Block catégories sur l\'accueil');
    }

    #region INSTALL
    /**
     * @inheritdoc
     */
    public function install()
    {
        if (parent::install()) {
            return (new \mdg\homecategorypush\Controllers\InstallerController)->install();
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function uninstall()
    {
        if (parent::uninstall()) {
            return (new \mdg\homecategorypush\Controllers\InstallerController)->uninstall();
        }

        return false;
    }
    #endregion

}

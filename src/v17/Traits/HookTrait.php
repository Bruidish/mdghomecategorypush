<?php
/**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2021-01-27
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.6
 */

namespace mdg\homecategorypush\v17\Traits;

if (!defined('_PS_VERSION_')) {
    exit;
}

trait HookTrait
{
    /** Charge les médias en front
     * @since PS 1.7
     *
     * @inheritdoc
     */
    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet("module-{$this->name}-front-css", "modules/{$this->name}/views/css/{$this->name}-front.css");
    }

    /** Charge le template de la page d'accueil
     *
     * @inheritdoc
     */
    public function hookDisplayHome(array $params)
    {
        return $this->renderWidget('displayHome');
    }

}

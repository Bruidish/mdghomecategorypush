<?php
/**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2021-01-27
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.7
 */

namespace mdg\homecategorypush\core\Traits;

use mdg\homecategorypush\Models\CategoryBlockModel;

if (!defined('_PS_VERSION_')) {
    exit;
}

trait WidgetTrait
{
    /**
     * @inheritdoc
     */
    public function renderWidget($hookName = null, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        return $this->fetch("module:{$this->name}/views/templates/hook/v17/blocks.tpl");
    }

    /**
     * @inheritdoc
     */
    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        $output = [
            'elements' => null,
            'hookName' => $hookName,
        ];

        // Récupère les éléments disponibles
        $collectionQuery = (new \PrestaShopCollection(CategoryBlockModel::class, $this->context->language->id))
            ->where("active", "=", "1")
            ->orderBy('position');

        $output['elements'] = $collectionQuery->getResults();
        foreach ($output['elements'] as &$element) {
            $element->category_link = $this->context->link->getCategoryLink($element->id_object);
            foreach (CategoryBlockModel::IMAGES_NAMES as $imageName => $imageParams) {
                $element->{$imageName} = CategoryBlockModel::getImageURL($element->id, $imageName, $imageParams['ext']);
            }
        }

        return $output;
    }

}

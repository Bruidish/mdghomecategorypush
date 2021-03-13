<?php
/**
 * @author:  Michel Dumont <webxy.com>
 * @version: 1.0.0 - 2021-01-27
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.7
 */

namespace mdg\homecategorypush\core\Forms;

class CategoryBlockForm extends \mdg\homecategorypush\Forms\ObjectForm
{
    /**
     * @inheritdoc
     */
    public function __construct($object = null, $legacyContext = null)
    {
        parent::__construct($object, $legacyContext);
        parent::constructFormHelper(__FILE__, $object);
    }

    /**
     * @inheritdoc
     */
    public function modifyControllerFormHelper()
    {
        // Paramètres pour les images
        $nocache = '?' . time();
        foreach ($this->object::IMAGES_NAMES as $imageName => $imgParams) {
            $fileUrl = $this->object::getImageUrl($this->object->id, $imageName, $imgParams['ext']);
            ${"{$imageName}_html"} = $fileUrl ? "<img src=\"{$fileUrl}{$nocache}\" height=\"120\" />" : false;
            ${"{$imageName}_delete"} = $this->context->link->getAdminLink($this->form_name, true, [], [$this->identifier => $this->object->id, "update{$this->table}" => 1, "deleteImage" => $imageName]);
        }

        // Champs du formulaire
        $this->fields_form = [];
        $this->fields_form[] = [
            'form' => [
                'legend' => [
                    'title' => $this->module->l('Main content', $this->form_name),
                    'icon' => 'icon-align-left',
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->module->l('Title', $this->form_name),
                        'name' => 'title',
                        'lang' => true,
                        'required' => true,
                    ],
                    [
                        'type' => 'textarea',
                        'label' => $this->module->l('Text', $this->form_name),
                        'name' => 'text',
                        'class' => 'autoload_rte',
                        'lang' => true,
                    ],
                    [
                        'type' => 'categories',
                        'label' => $this->module->l('Categories', $this->form_name),
                        'name' => 'id_object',
                        'tree' => [
                            'root_category' => 2,
                            'id' => 'id_category',
                            'name' => 'name_category',
                            'selected_categories' => [(int) $this->object->id_object],
                        ],
                    ],
                ],
            ],
        ];
        $this->fields_form[] = [
            'form' => [
                'legend' => [
                    'title' => $this->module->l('Images setting', $this->form_name),
                    'icon' => 'icon-picture-o',
                ],
                'input' => [
                    [
                        'type' => 'file',
                        'label' => $this->module->l('Main image', $this->form_name),
                        'name' => 'image',
                        'display_image' => true,
                        'image' => $image_html ? $image_html : false,
                        'delete_url' => $image_delete,
                        'desc' => sprintf($this->module->l('Use size %d x %dpx.', $this->form_name), $this->object::IMAGES_NAMES['image']['width'], $this->object::IMAGES_NAMES['image']['height']),
                    ],
                    [
                        'type' => 'file',
                        'label' => $this->module->l('On hover', $this->form_name),
                        'name' => 'image_hover',
                        'display_image' => true,
                        'image' => $image_hover_html ? $image_hover_html : false,
                        'delete_url' => $image_hover_delete,
                        'desc' => sprintf($this->module->l('Use size %d x %dpx.', $this->form_name), $this->object::IMAGES_NAMES['image_hover']['width'], $this->object::IMAGES_NAMES['image_hover']['height']),
                    ],
                ],
            ],
        ];
        $this->fields_form[] = [
            'form' => [
                'legend' => [
                    'title' => $this->module->l('Display setting', $this->form_name),
                    'icon' => 'icon-eye-open',
                ],
                'input' => [
                    [
                        'type' => 'switch',
                        'label' => $this->module->l('Display', $this->form_name),
                        'name' => 'active',
                        'values' => [
                            ['id' => 'active_on', 'value' => 1, 'label' => $this->module->l('Enabled', $this->form_name)],
                            ['id' => 'active_off', 'value' => 0, 'label' => $this->module->l('Disabled', $this->form_name)],
                        ],
                    ],
                ],
                'submit' => [
                    'title' => $this->module->l('Save', $this->form_name),
                    'icon' => 'process-icon-save',
                ],
            ],
        ];

        return parent::modifyControllerFormHelper();
    }

    /** Traite l'enregistrement du formulaire de la page produit
     *
     * @param array datas à enregistrer
     *
     * @return bool
     */
    public function processForm($formData)
    {
        $output = true;

        // Enregistrement des données
        foreach ($this->object::$definition['fields'] as $fieldName => $fieldParams) {
            $this->object->{$fieldName} = (isset($formData[$fieldName]) ? $formData[$fieldName] : $this->object->{$fieldName});
        }

        $output &= $this->object->save();

        return $output;
    }
}

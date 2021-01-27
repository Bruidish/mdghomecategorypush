<?php
/**
 * @author Michel Dumont <michel.dumont.io>
 * @version 1.0.0 - 2021-01-27
 * @copyright 2020
 * @license http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package prestashop 1.7
 */

namespace mdg\homecategorypush\core\Models;

if (!defined('_CAN_LOAD_FILES_')) {
    exit;
}

class CategoryBlockModel extends \mdg\homecategorypush\Models\ObjectModel
{
    /** @var array paramètres des différentes images du block */
    const IMAGES_NAMES = [
        'image' => ['width' => 710, 'height' => 710, 'ext' => 'png'],
        'image_hover' => ['width' => 710, 'height' => 710, 'ext' => 'png'],
    ];

    /** @var int id de l'obket Prestashop associé */
    public $id_object;

    /** @var bool */
    public $active;

    /** @var int */
    public $position;

    /** @var string [lang] */
    public $title;

    /** @var string [lang] */
    public $text;

    /** @var string [lang] */
    public $button_text;

    public static $definition = [
        'table' => 'mdghomecategorypush_cateforyblock',
        'primary' => 'id_association',
        'multilang' => true,
        'multi_shop' => true,
        'fields' => [
            'id_object' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'position' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],

            'title' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'lang' => true],
            'text' => ['type' => self::TYPE_HTML, 'validate' => 'isCleanHtml', 'lang' => true],
            'button_text' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'lang' => true],
        ],
    ];

    /** Instancie cette classe à l'objet Prestashop associé
     *
     * @param int id de l'object associé
     *
     * @return self
     */
    public static function getInstanceByIdObject($idObject)
    {
        $id = \Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue("SELECT " . static::$definition['primary'] . " FROM " . _DB_PREFIX_ . static::$definition['table'] . " WHERE id_object={$idObject}");

        if (!$id) {
            $that = new self();
            $that->id_object = $idObject;
            $that->add();
            $id = $that->id;
        }

        return new self($id);
    }

    #region IMAGES
    /** Retourne l'url de l'image
     *
     * @param int id de l'objet
     * @param string type de l'image
     * @param string extension de l'image
     *
     * @return string|false
     */
    public static function getImageUrl($id, $name, $ext = null)
    {
        $ext = $ext ? $ext : static::IMAGES_NAMES[$name]['ext'];
        $dirName = static::$definition['table'];
        if (file_exists(_PS_IMG_DIR_ . "{$dirName}/{$id}-{$name}.{$ext}")) {
            return _PS_IMG_ . "{$dirName}/{$id}-{$name}.{$ext}";
        }

        return false;
    }

    /** Supprime l'image de l'objet
     *
     * @param int
     *
     * @return bool
     */
    public function deleteImageByName($name)
    {
        $output = true;
        $ext = static::IMAGES_NAMES[$name]['ext'];
        $dirName = static::$definition['table'];
        $img = _PS_IMG_DIR_ . "{$dirName}/{$this->id}-{$name}.{$ext}";
        if (file_exists($img)) {
            $output &= (bool) unlink($img);
        }
        return $output;
    }

    #endregion IMAGES

}

<?php
/**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2021-06-25
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.6 | 1.7
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_0_3($module)
{
    $sql = [];
    $db = \Db::getInstance();

    // Dossier images
    rename(_PS_IMG_DIR_ . "mdghomecategorypush_cateforyblock", _PS_IMG_DIR_ . "mdghomecategorypush_categoryblock");

    // Requettes sql
    $sql[] = "
        ALTER TABLE `" . _DB_PREFIX_ . "mdghomecategorypush_cateforyblock`
        RENAME TO `" . _DB_PREFIX_ . "mdghomecategorypush_categoryblock`
    ";
    $sql[] = "
        ALTER TABLE `" . _DB_PREFIX_ . "mdghomecategorypush_cateforyblock_lang`
        RENAME TO `" . _DB_PREFIX_ . "mdghomecategorypush_categoryblock_lang`
    ";

    // Traitement SQL
    foreach ($sql as $s) {
        if (!$db->execute($s)) {
            return false;
        }
    }

    return true;
}

<?php
/**
 * User: Tups <damien@tups.fr>
 * Date: 11/05/2021
 * Time: 18:55
 */

namespace PrestaShop\Module\LpmiSupplier;
use PrestaShop\PrestaShop\Adapter\Entity\Supplier;
use PrestaShopBundle\Entity\Repository\SupplierRepository;

class SupplierNotif extends Supplier
{

    /** @var string */
    public $email;
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'supplier',
        'primary' => 'id_supplier',
        'multilang' => true,
        'fields' => [
            'name' => ['type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64],
            'email' => ['type' => self::TYPE_STRING,  'validate' => 'isEmail', 'size' => 255],
            'active' => ['type' => self::TYPE_BOOL],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],

            /* Lang fields */
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
            'meta_title' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
            'meta_description' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 512],
            'meta_keywords' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255],
        ],
    ];

    public static function migrateUp() {
        \Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'supplier` ADD `email` VARCHAR(255) NOT NULL AFTER `active`; ');
    }

    public static function migrateDown() {
        \Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'supplier` DROP `email`;');
    }

}

<?php
/**
 * Created by Lord of Web.
 * User: Damien
 * Date: 02/01/2019
 * Time: 11:16
 */


if (!defined('_PS_VERSION_'))
    exit;

if (!class_exists('TupsCoreModule', false)) {
    include_once __DIR__.'/../tupsmodulehelper/TupsCoreModule.php';
}

$folderModule = __DIR__;



class LpFournisseurs extends TupsCoreModule
{
    public $configDisplayName = 'Liste des fournisseurs';
    public $configDescription = "Module pour afficher la liste des fournisseurs pour la commande";

    protected $_hook = array(
        'displayAdminOrderTabContent' => array(
            'position' => 1,
        ),
        'displayAdminOrderContentOrder' => array(
            'position' =>2,
        ),
        'displayAdminOrderTabLink' => array(
            'position' =>2,
        ),
        'displayAdminOrderTabOrder' => array(
            'position' =>2,
        ),
        'actionOrderStatusPostUpdate' => array(
            'position' => 1
        )
    );

    public function __construct() {
        parent::__construct();
        $this->meta_title = $this->l('Fournisseurs', $this->name);
    }

    public function hookDisplayAdminOrderContentOrder($params)
    {
        if (version_compare(_PS_VERSION_, '1.7.7.4', '>=')) {
            $order = new Order($params['id_order']);
        } else {
            $order = $params['order'];
        }


        $products = $order->getProducts();
        $suppliers = [];
        foreach ($products as $product){
            $supplier = new \PrestaShop\Module\LpmiSupplier\SupplierNotif($product['id_supplier']);
            array_push($suppliers, $supplier);
        }

        $this->smarty->assign (array(
            'products' => $products,
            'suppliers' => $suppliers
        ));

        return $this->display(__FILE__, 'views/templates/hook/admin_content_order.tpl');
    }

    public function hookDisplayAdminOrderTabContent($params)
    {
        return $this->hookDisplayAdminOrderContentOrder($params);
    }

    public function hookDisplayAdminOrderTabLink($params)
    {
        return $this->hookDisplayAdminOrderTabOrder($params);
    }

    public function hookActionOrderStatusPostUpdate($params){
//        $order = $params['order'];
        if($params['newOrderStatus']->name === 'Paiement accepté') {

            $order = new Order($params['id_order']);
            $products = $order->getCartProducts();

            $suppliers = [];
            foreach ($products as $product){
                $supplier = new \PrestaShop\Module\LpmiSupplier\SupplierNotif($product['id_supplier']);
                array_push($suppliers, $supplier);
            }

            foreach ($suppliers as $supplier){
                Mail::Send(
                    (int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
                    'contact', // email template file to be use
                    ' Module Installation', // email subject
                    array(
                        '{email}' => Configuration::get('PS_SHOP_EMAIL'), // sender email address
                        '{message}' => 'Le paiement a été accepté pour la commande.' // email content
                    ),
                   $supplier->email, // receiver email address
                    NULL, //receiver name
                    NULL, //from email address
                    NULL  //from name
                );
            }

        }


    }
    /**
     * Add a tab to controle intents on an order details admin page (tab header)
     * @return html
     */
    public function hookDisplayAdminOrderTabOrder($params)
    {

        return $this->display(__FILE__, 'views/templates/hook/admin_tab_order.tpl');
    }


}
<?php
/**
 * Created by Lord of Web.
 * User: Damien
 * Date: 02/01/2019
 * Time: 11:16
 */


use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\TypedRegex;
use PrestaShop\PrestaShop\Core\Domain\Supplier\SupplierSettings;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

if (!defined('_PS_VERSION_'))
    exit;

if (!class_exists('TupsCoreModule', false)) {
    include_once __DIR__.'/../tupsmodulehelper/TupsCoreModule.php';
}

$folderModule = __DIR__;

require_once $folderModule.'/vendor/autoload.php';

class LpmiSupplier extends TupsCoreModule
{


    public $configDisplayName = 'Notification fournisseurs';
    public $configDescription = "Notifier les fournisseurs de chaque produit";

    protected $_override = array(

    );

    public function migrateDownBdd()
    {
       // \PrestaShop\Module\LpmiSupplier\SupplierNotif::migrateDown();
    }

    public function migrateUpBdd()
    {
        \PrestaShop\Module\LpmiSupplier\SupplierNotif::migrateUp();
    }


    // Installation des hooks
    protected $_hook = array(
        'actionOrderStatusUpdate' => array(
            'position' => 1,
        ),
        'actionSupplierFormBuilderModifier' => array(
            'position' => 1,
        ),
        'actionBeforeUpdateSupplierFormHandler' => array(
            'position' => 1,
        ),
    );


    public function hookActionOrderStatusUpdate($params) {

        $newOrderStatus = $params['newOrderStatus'];
        $newOrderStatus = $params['id_order'];

        //..
        //..

    }

    public function hookActionSupplierFormBuilderModifier(&$params) {
        /** @var Symfony\Component\Form\FormBuilder $form_builder */
        $form_builder = $params['form_builder'];
        $data = $params['data'];
        $options = $params['options'];
        $id = $params['id'];

        $form_builder
            ->add('email', TextType::class, [
                'label' => 'E-mail',
                'required' => false
            ]);

        $supplier = new \PrestaShop\Module\LpmiSupplier\SupplierNotif($params['id']);
        $params['data']['email'] = $supplier->email;

        $form_builder->setData($params['data']);

    }

    public function hookActionBeforeUpdateSupplierFormHandler($params) {

        $email = $params['form_data']['email'];
        $supplier = new \PrestaShop\Module\LpmiSupplier\SupplierNotif($params['id']);
        $supplier->email = $email;
        $supplier->save();



    }


}

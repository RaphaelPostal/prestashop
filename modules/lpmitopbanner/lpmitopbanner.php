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

require_once $folderModule.'/vendor/autoload.php';

class LpmiTopBanner extends TupsCoreModule
{
    public $configDisplayName = 'Bannière Haut de site';
    public $configDescription = "Module pour afficher un texte en haut de page";

    const CONFIG_TEXT = 'texte';
    const CONFIG_COLOR = 'blue';

    protected $_override = array(
        //'classes/Cart.php'
    );


    // Installation des hooks
    protected $_hook = array(
        'displayBanner' => array(
            'position' => 1,
        ),
    );

    public function hookDisplayBanner($params) {
        $couleur = self::getConfig(self::CONFIG_COLOR);
        $texte = self::getConfig(self::CONFIG_TEXT);

        $this->smarty->assign(
            array(
                'couleur' => $couleur,
                'texte' => $texte
            )
        );

        return $this->display($this->path, 'banner.tpl');
    }


    // affichage de la configuration du module
    public function __construct() {
        parent::__construct();
        // Ajouter un formule sur la configuration du module
        $this->addConfigForm($this->getFormConfiguration());
    }

    // Exemple de la creation d'un formulaire pour la configuration
    // Pour connaitre tous les types de champs existant, il faut aller voir dans Prestashop :
    // /controllers/admin/AdminPatternsController.php
    public function getFormConfiguration() {
        return array(
            'form' => array(
                'tab_name' => 'config_tab',
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => 'Texte',
                        'desc' => "Séparateur virgule",
                        'name' => self::getConfigName(self::CONFIG_TEXT),
                    ),
                    array(
                        'type' => 'color',
                        'label' => 'Couleur',
                        'desc' => "Séparateur virgule",
                        'name' => self::getConfigName(self::CONFIG_COLOR),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }



}

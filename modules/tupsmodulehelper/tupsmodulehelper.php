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
    include_once __DIR__ . '/TupsCoreModule.php';
}

class TupsModuleHelper extends TupsCoreModule
{

    public $configDisplayName = 'Module Helper';
    public $configDescription = 'Permet de mettre en place un module facilement';

    // Installation des hooks
    protected $_hook = array(
        // Nom du hook
//        'displayHeader' => array(
//            'position' => 3 // Position du hook
//        ),
    );

    // Installer des Hook pour d'autre module et/ou changer leur position que le sien
    protected $_hook_other_module = array(
//        'blocksocial_mod' => array(
//            'displayFooterTheme' => array(
//                'position' => 1
//            )
//        ),
//        'blocknewsletter' => array(
//            'displayFooterTheme' => array(
//                'position' => 2
//            )
//        ),
//        'blocklayered' => array(
//            'displayLayered' => array(
//                'position' => 1
//            )
//        ),

    );

    // Désinstaller des Hook pour d'autre module
    protected $_unregister_hook_other_module = array(
//        'blocknewsletter' => array(
//            'displayFooter' => array()
//        ),
    );

    // Si on a des overrides, on donne le chemin depuis le dossier override du module
    // Si on met une nouvelle classe, dans override, elle sera automatique Load par Prestashop,
    // cela évite de l'inclure dans le PHP du module et donne accès à la classe partout
    protected $_override = array(
//        'classes/ThemeFooter.php',
    );

    // Nom du fichier du controller Front
    // Attention, le nom de la class de ce controller front doit s'écrire de la façon suivante
    // lowmodulefollowupModuleFrontController
    // ça donne nom du module en minuscule + nom du controller en minuscule + ModuleFrontController
    public $controllers = array(
//        'followup',
    );


    // Permet d'installer proprement le controller
    public $rewriteControllers = array(
//        'followup' => array( // Nom du controller
//            'meta_lang' => array( // Remplir les métas de la page, par numéro de lang
//                1 => array(
//                    'title' => 'Appel d\'offre',
//                    'url_rewrite' => 'mamies-follow-up',
//                    'description' => '',
//                    'keywords' => ''
//                ),
//                2 => array(
//                    'title' => 'Appel d\'offre',
//                    'url_rewrite' => 'mamies-follow-up',
//                    'description' => '',
//                    'keywords' => ''
//                )
//            ),
//            // Configuration du theme, pour savoir si on a besoin de la colonne de gauche et droite
//            'theme' => array(
//                'left' => false,
//                'right' => false,
//            )
//        ),
    );

    // Installation des controllers Admin
    // Le premier controller déclarer sera la tabulation parent du menu admin
    protected $_tabController = array(
//        [
//            'title' => 'LOW Admin',
//            'class_name' => 'AdminLow', // Doit être present dans le dossier /controllers/admin/AdminLowController.php
//            'show' => true, // Determine si le controller s'affiche dans le menu prestashop
//            'position' => 4, // Positionner le menu
//            // 'parentClassName' => 'AdminLow' // Définir la tab parent si custom
//        ],
        // Exemple d'un controller AJAX dans l'admin
//        [
//            'title' => 'MamyFactory - Admin Order Ajax ',
//            'class_name' => 'AdminMamyOrderProposal',
//            'show' => false, // ne pas afficher le controller dans le menu
//
//        ],
    );


    // Permet de déclarer de nouveau type de champ dans les formules
    protected $_customField = array('');

    /**
     * Permet de setter les valeurs des inputs Custom si besoin
     * @param array $input
     * @return array|string
     */
    protected function setDataCustomField($input) {
        switch ($input['type']) {
            default:
                return '';
                break;
        }

        return '';
    }


    /**
     * Permet de sauvegarder les valeurs des inputs Custom si besoin
     * @param array $input
     * @return array|string
     */
    protected function updateDataCustomField($input) {
        switch ($input['type']) {
            default:
                return '';
                break;
        }
    }


    // Permet de créer les tables à l'installation du module
    public function migrateUpBdd() {


//        $result = Db::getInstance()->execute('
//				CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'themefooter` (
//				`id_footer` INT UNSIGNED NOT NULL AUTO_INCREMENT,
//				`id_shop` int(10) unsigned DEFAULT NULL,
//				`col` int(10) unsigned DEFAULT NULL,
//				`position` int(10) unsigned DEFAULT NULL,
//				PRIMARY KEY (`id_footer`)
//			) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8 ;'
//        );
//
//        $result = Db::getInstance()->execute('
//				CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'themefooter_lang` (
//				`id_footer` INT UNSIGNED NOT NULL,
//				`id_lang` int(10) unsigned NOT NULL ,
//				`text` text NOT NULL,
//				PRIMARY KEY (`id_footer`, `id_lang`)
//			) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8 ;'
//        );

    }

    // Permet de supprimer les tables à la desinstallation du module
    public function migrateDownBdd() {
//        Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . 'themefooter`;');
//        Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . 'themefooter_lang`;');

    }

    // vider le cache de ces templates
    public function clearCacheModule() {
        // $this->_clearCache('views/templates/front/hookDisplayFooter.tpl');
    }


    // affichage de la configuration du module
    public function __construct() {
        parent::__construct();
        // Ajouter un formule sur la configuration du module
        $this->addConfigForm($this->getFormConfiguration());
    }

    // Exemple de la creation d'un formulaire pour la configuration
    // Pour connaitre tous les types de champs existant, il faut aller voir dans Prestashop : /controllers/admin/AdminPatternsController.php
    public function getFormConfiguration() {
        return array(
            'form' => array(
                'tab_name' => 'config_tab',
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Module à reset'),
                        'name' => self::getConfigName('module'),
                        'desc' => '/!\ Enregistrer avant de reset'
                    ),
                    array(
                        'type' => 'html',
                        'label' => $this->l('Dev'),
                        'name' => 'dev',
                        'html_content' => $this->getHtmlResetCustom(),
                    ),
                ),

                'submit' => array(
                    'title' => $this->l('Save'),
                )
            )
        );
    }

    public function checkSubmit($forms)
    {
        parent::checkSubmit($forms); // TODO: Change the autogenerated stub

        if (\Tools::isSubmit('resetAuthorizationModule')) {

            $this->autorisationSetup(self::REMOVE,  self::getConfig('module'));
            $this->autorisationSetup(self::ADD, self::getConfig('module'));

            $this->_html .= $this->displayConfirmation($this->l('Authorization '.self::getConfig('module').' Reset ! '));
        }

    }

    public function getHtmlResetCustom()
    {
        return '
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-default" type="submit" name="resetAuthorizationModule">Reset Authorisation Module</button>
    </div>
</div>';
    }







}

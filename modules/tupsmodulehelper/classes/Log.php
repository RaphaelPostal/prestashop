<?php

namespace PrestaShop\Module\TupsModule;

/**
 * User: lord
 * Date: 15/09/2017
 * Time: 14:31
 */
class Log
{

    /**
     * @var string name of logs folder
     */
    public static $logsFolder = 'logs';

    protected $file;

    /**
     * Construct
     *
     * @param string $fileName log file name
     */
    public function __construct($name = 'Début du log')
    {

        $this->checkFolder();

        //if (empty($fileName)) {
            $fileName = 'logs-' . date('Y-m-d') . '.txt';
        //}

        $this->file = fopen($this->getPath($fileName), $mode = 'a+');

	    $log = "\r\n".'--- '. $name . ' : '. date('Y-m-d : H:i:s') . ' ---' . "\r\n";

	    fwrite($this->file, $log);
    }

    /**
     * @param string $fileName
     */
    public function getPath($fileName) {

    	/** @var \LowModule $module */
    	$module = \Module::getInstanceByName('LowModule');

        return _PS_MODULE_DIR_ . DIRECTORY_SEPARATOR . $module::getName() . DIRECTORY_SEPARATOR . self::$logsFolder . DIRECTORY_SEPARATOR.$fileName;
    }

    /**
     * @param $message
     * @param $idRef
     */
    public function write($message, $idRef = '')
    {
        $log = date('Y-m-d : H:i:s') . ' - ' . (empty($idRef) ? '' : 'Ref ' . $idRef . ': ');
        $log .= $message . "\r\n";

        fwrite($this->file, $log);
    }

    protected function checkFolder() {
        $scandir = new \Helper\ScanDir();
        $scandir->createFolder($this->getPath(''));
    }


}

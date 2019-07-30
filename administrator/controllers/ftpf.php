<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Descargas
 * @author     aficat <kim@aficat.com>
 * @copyright  2018 aficat
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Descarga controller class.
 *
 * @since  1.6
*/

class DescargasControllerFtpf extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	*/
	public function __construct()
	{
		$this->view_list = 'ftp';
		parent::__construct();
	}
}

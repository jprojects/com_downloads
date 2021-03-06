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

jimport('joomla.application.component.controller');

/**
 * Class DescargasController
 *
 * @since  1.6
*/

class DescargasController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   mixed   $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 * @return  JController   This object to support chaining.
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
        $app  = JFactory::getApplication();
        DescargasHelpersDescargas::getParameter('ftpmode', 0) == 0 ? $vista = 'descargas' : $vista = 'ftp'; //si ftp mode esta activo redirigimos a la vista adecuada
        $view = $app->input->getCmd('view', $vista);
		$app->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}

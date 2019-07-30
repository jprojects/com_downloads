<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Descargas
 * @author     aficat <kim@aficat.com>
 * @copyright  2018 aficat
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Documentos list controller class.
 *
 * @since  1.6
 */
class DescargasControllerDocumentos extends DescargasController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return object	The model
	 *
	 * @since	1.6
	 */
	public function &getModel($name = 'Documentos', $prefix = 'DescargasModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}
	
	public function download()
	{
		$db  = JFactory::getDbo();
		$app = JFactory::getApplication();
		
		$id   = $app->input->get('id');
		$file = base64_decode($app->input->get('file'));
		
		$db->setQuery('UPDATE #__descargas_documentos SET counter = counter + 1 WHERE id = '.$id);
		$db->query();
		
		$this->setRedirect(JURI::root().'descargas/'.$file);
	}
}

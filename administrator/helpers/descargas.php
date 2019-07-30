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

/**
 * Descargas helper.
 *
 * @since  1.6
*/

class DescargasHelper
{
	/**
	 * Configure the Linkbar.
	 * @param   string  $vName  string
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{	
		if(DescargasHelper::getParameter('ftpmode', 0) == 0) { //si ftp mode esta activo no mostramos los enlaces del modo manual			
			JHtmlSidebar::addEntry(
				JText::_('COM_DESCARGAS_TITLE_CATEGORIES'),
				'index.php?option=com_categories&extension=com_descargas',
				$vName == 'categories'
			);

			JHtmlSidebar::addEntry(
				JText::_('COM_DESCARGAS_TITLE_DESCARGAS'),
				'index.php?option=com_descargas&view=descargas',
				$vName == 'descargas'
			);
		}
		
		JHtmlSidebar::addEntry(
			JText::_('COM_DESCARGAS_TITLE_FTP'),
			'index.php?option=com_descargas&view=ftp',
			$vName == 'ftp'
		);
	}
	
	/**
	 * method to get component parameters
	 * @param string $param
	 * @param mixed $default
	 * @return mixed
	*/
	public static function getParameter($param, $default="")
	{
		$params = JComponentHelper::getParams( 'com_descargas' );
		$param = $params->get( $param, $default );
	
		return $param;
	}

	/**
	 * Gets the files attached to an item
	 * @param   int     $pk     The item's id	
	 * @param   string  $table  The table's name
	 * @param   string  $field  The field's name
	 * @return  array  The files
	 */
	public static function getFiles($pk, $table, $field)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($field)
			->from($table)
			->where('id = ' . (int) $pk);

		$db->setQuery($query);

		return explode(',', $db->loadResult());
	}

	/**
	 * Gets a list of the actions that can be performed.
	 * @return    JObject
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_descargas';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}


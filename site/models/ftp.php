<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Descargas
 * @author     aficat <kim@aficat.com>
 * @copyright  2018 aficat
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Descargas records.
 *
 * @since  1.6
*/

class DescargasModelFtp extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see        JController
	 * @since      1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				
			);
		}

		parent::__construct($config);
	}        
        
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 *
	 * @since    1.6
	*/
	protected function populateState($ordering = null, $direction = null)
	{
        $app  = JFactory::getApplication();

        parent::populateState('a.ordering', 'asc');
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	*/
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		
		$app  = JFactory::getApplication();
		$id   = $app->input->get('id', 0);

		// Select the required fields from the table.
		$query->select('a.*');

		$query->from('`#__descargas_ftp` AS a');
		
		$query->where('a.state = 1 AND a.id = '.$id);				

		return $query;
	}

	/**
	 * Method to get an array of data items
	 * @return  mixed An array of data on success, false on failure.
	*/
	public function getItems()
	{
		$items = parent::getItems();

		return $items;
	}
	
	/**
	 * Method to get an array of folders from a given path
	 * @return  mixed An array of data on success, false on failure.
	*/
	public function getFolders($path)
	{
		jimport('joomla.filesystem.folder');
		
		if(!defined('DS')){
  			define('DS',DIRECTORY_SEPARATOR);
		}
		
		$app  	= JFactory::getApplication();
		$folder = $app->input->get('folder', '', 'raw');
		
		$path   = JPATH_ROOT.DS.$path.DS.'principal';	
		
		if($folder != '') { $path = $path.DS.$folder; }			
		
		$folders = JFolder::folders($path, $filter = '.', false, false);

		return $folders;
	}
	
	/**
	 * Method to get an array of files from a given path
	 * @return  mixed An array of data on success, false on failure.
	*/
	public function getFiles($path)
	{
		jimport('joomla.filesystem.folder');
		
		if(!defined('DS')){
  			define('DS',DIRECTORY_SEPARATOR);
		}
		
		$app  	= JFactory::getApplication();
		$folder = $app->input->get('folder', '', 'raw');
		
		$path   = JPATH_ROOT.DS.$path.DS.'principal';	
		
		if($folder != '') { $path = $path.DS.$folder; }
		
		$files = JFolder::files($path, $filter = '.', false, false);

		return $files;
	}
	
	/**
	 * Method to get an array of files from a given path
	 * @return  mixed An array of data on success, false on failure.
	*/
	public function getThumb($folder, $file)
	{
		if(!defined('DS')){
  			define('DS',DIRECTORY_SEPARATOR);
		}
		
		$path = JPATH_ROOT.DS.$path.DS.'vista_previa'.DS.$folder;
		$file_parts = pathinfo($path.DS.file);						
		
		if(file_exists($path.DS.$file_parts['filename'].'.jpg')) { return $file; }
	}

	/**
	 * Overrides the default function to check Date fields format, identified by
	 * "_dateformat" suffix, and erases the field if it's not correct.
	 *
	 * @return void
	*/
	protected function loadFormData()
	{
		return parent::loadFormData();
	}
}

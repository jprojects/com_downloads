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
class DescargasControllerDescarga extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'descargas';
		parent::__construct();
	}
	
	public function upload()
	{   
		$jinput  = JFactory::getApplication()->input;
        $file    = $jinput->files->get('jform');  
       	$allowed = array('pdf', 'xlsm', 'xls', 'doc', 'docx', 'xlsx', 'odt');
       	
       	$id = $jinput->get('id', 0, 'get');

    	jimport('joomla.filesystem.file');
     
    	$filename = JFile::makeSafe($file['subida']['name']);

    	$src  = $file['subida']['tmp_name'];
    	$dest = JPATH_ROOT."/descargas/".$filename;
    	$extension = strtolower(JFile::getExt($filename)); 

    	if ( in_array($extension, $allowed) ) {
       		if ( JFile::upload($src, $dest) ) {
				$msg = JText::_('COM_DESCARGAS_UPLOAD_OK');
				$type = 'info';
				if($id != 0) {
					$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit&id='.$id, $msg, $type);
				} else {
					$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit', $msg, $type);
				}
       		} else {
          		$msg = JText::_('COM_DESCARGAS_TASK_UPLOAD_ERROR');
				$type = 'error';
				if($id != 0) {
					$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit&id='.$id, $msg, $type);
				} else {
					$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit', $msg, $type);
				}
       		}
    	} else {
       		$msg = JText::_('COM_DESCARGAS_TASK_UPLOAD_ONLY_XLS');
			$type = 'error';
			if($id != 0) {
				$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit&id='.$id, $msg, $type);
			} else {
				$this->setRedirect('index.php?option=com_descargas&view=descarga&layout=edit', $msg, $type);
			}
    	}
	}
}

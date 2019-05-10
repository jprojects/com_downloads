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

use Joomla\Utilities\ArrayHelper;
/**
 * documento Table class
 *
 * @since  1.6
 */
class DescargasTableDescargas extends JTable
{
	
	/**
    * Constructor
    *
    * @param object Database connector object
    */
    function __construct( &$db ) {
    	parent::__construct('#__descargas_documentos', 'id', $db);
    }
}

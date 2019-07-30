<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_descargas
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Descargas Component Route Helper
 *
 * @static
 * @package     Joomla.Site
 * @subpackage  com_descargas
 * @since       1.5
 */
abstract class DescargasHelperRoute
{
	/**
	 * Get the URL route for a descargas from a descargas ID, descargas category ID and language
	 *
	 * @param   integer  $id        The id of the descargas
	 * @param   integer  $catid     The id of the descargas's category
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the descargas
	 *
	 * @since   1.5
	 */
	public static function getDescargaRoute($filename)
	{
		// Create the link
		$link = JURI::root().'descargas/' . $filename;

		return $link;
	}
}

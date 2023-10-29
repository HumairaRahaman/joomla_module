<?php
defined('_JEXEC') or die;

/**
 * @package		ThemeXpert
 * @subpackage	plg_system_compressor
 */
class plgSystemJbarInstallerScript
{
	/**
	 * Post-flight extension installer method.
	 *
	 * This method runs after all other installation code.
	 *
	 * @param	$type
	 * @param	$parent
	 */
	function postflight($type, $parent)
	{
		// Display a nice installed message.
		echo JText::sprintf(
			'PLG_SYSTEM_COMPRESSOR_INSTALLED',
			'1.0'
		);
	}
}

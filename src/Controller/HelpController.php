<?php
/**
 * @file PdfGeneratorController.php
 *
 * Ce fichier contient la classe PdfGeneratorController.
 * En cours ...
 *
 * Namespace : Drupal\pdf_generator_drupal_module
 *
 * Contains : Drupal\pdf_generator_drupal_module\Utils\UtilsFolderAndFiles
 */
namespace Drupal\pdf_generator_drupal_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the help page.
 */
class HelpController extends ControllerBase {

	/**
	 * Displays the help page.
	 *
	 * @return array
	 *   The render array for the help page.
	 */
	public function helpPage() {
		// Replace 'pdf_generator' with your module's machine name.
		return \Drupal::moduleHandler()->invoke('pdf_generator_drupal_module', 'help');
	}

}
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
		/*
		// Replace 'pdf_generator' with your module's machine name.
		return \Drupal::moduleHandler()->invoke('pdf_generator_drupal_module', 'help');
		*/

		// Vérifiez que la méthode est appelée.
		\Drupal::logger('PDF Generator')->notice('help called');

		$content = '';
		$content .= '<h3>' . 'À propos' . '</h3>';
		$content .= '<p>' . 'Ce module permet de générer un fichier PDF.' . '</p>';

		// Utilisation du module.
		$content .= '<h3>' . 'Uses' . '</h3>';
		$content .= '<div>';
		$content .= '<dt>' . 'Creating Paragraphs types' . '</dt>';
		$content .= '<dd>' . '<em>Paragraphs types</em> can be created by ...' . '<dd>';
		$content .= '</div>';

		// Dépendances du module.
		$content .= '<h4>' . 'Dépendances du module' . '</h4>';
		$content .= '<p>' . 'Ce module à pour packages de dépendances :' . '</p>';
		$content .= '<ul>';
		$link = 'https://packagist.org/packages/esiee/pdf_generator_composer_package';
		$content .= '<li>' . '<a href="'.$link.'">esiee/pdf_generator_composer_package</a>' . '</li>';
		$content .= '</ul>';

		// Affichage de la page d'aide du module.
		return [
			'#markup' => $this->t($content),
		];
	}

}
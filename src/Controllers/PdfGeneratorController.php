<?php
/**
 * @file PdfGeneratorController.php
 *
 * Ce fichier contient la classe PdfGeneratorController.
 * En cours ...
 *
 * Namespace : Drupal\pdfgenerator
 *
 * Contains : Drupal\pdfgenerator\Utils\UtilsFolderAndFiles
 */
namespace Drupal\pdfgenerator\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Drupal\pdfgenerator\Utils\UtilsFolderAndFiles;

class PdfGeneratorController extends ControllerBase{

	/**
	 * Méthode de lecture du noms des fichiers de polices
	 * dans le dossier des polices à la racine du module
	 * avec la classe UtilsFolderAndFiles
	 * @param $dossier
	 * @return array
	 */
	public function lireFichiersPolicesDansDossier($dossier) {
		$strings = array();
		$strings[] = 'Default system';
		foreach (UtilsFolderAndFiles::lireFichiersDansDossier($dossier) as $fichier) {
			$strings[] = $fichier;
		}
		return $strings;
	}

	/**
	 * Méthode de génération du PDF à partir d'un noeud de type article
	 * @param $node
	 * @return void
	 */
	public function generatePdf($node_id){
		// Vérifiez que la méthode est appelée et que le paramètre est reçu.
		\Drupal::logger('PDF Generator')->notice('yourMethod called with node_id: ' . $node_id);

		print 'generatePdf';
	}
}

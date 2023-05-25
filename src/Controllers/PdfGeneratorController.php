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
namespace Drupal\pdfgenerator;

use Drupal\pdfgenerator\Utils\UtilsFolderAndFiles;

class PdfGeneratorController {

	/**
	 * Méthode de lecture du noms des fichiers de polices
	 * dans le dossier des polices à la racine du module
	 * avec la classe UtilsFolderAndFiles
	 * @param $dossier
	 * @return array
	 */
	public function lireFichiersPolicesDansDossier($dossier) {
		return UtilsFolderAndFiles::lireFichiersDansDossier($dossier);
	}
}

<?php
/**
 * @file UtilsFolderAndFiles.php
 *
 * Ce fichier contient la classe UtilsFolderAndFiles.
 * En cours ...
 *
 * Namespace : Drupal\pdf_generator_drupal_module\Utils
 *
 * Contains : ...
 */
namespace Drupal\pdf_generator_drupal_module\Utils;

class UtilsFolderAndFiles {

	/**
	 * Méthode de lecture des fichiers dans un dossier
	 * @param $dossier
	 * @return array
	 */
	public static function lireFichiersDansDossier($dossier) {
		$results = array();

		// Vérifie si le dossier existe
		if (!is_dir($dossier)) {
			/*
			// Affichage d'un message d'erreur dans le log
			\Drupal::logger('pdfgenerator')->error('[PDF Generator] Le dossier "'.$dossier.'" n\'existe pas.');
			// Affichage d'un message d'erreur dans le log CURL
			\Drupal::logger('pdfgenerator')->error('[PDF Generator] Le dossier "'.$dossier.'" n\'existe pas.', array(), array('channel' => 'curl'));
			//-
			print "[PDF Generator] Le dossier ".$dossier." n\'existe pas.";
			*/

			// Retourne null
			return null;
		} else {
			// Lit les fichiers dans le dossier
			$fichiers = scandir($dossier);

			// Boucle sur les fichiers
			foreach ($fichiers as $fichier) {
				// Exclut les dossiers '.' et '..'
				if ($fichier != '.' && $fichier != '..') {

					/**
					 * Nettoyage des noms de fichiers :
					 * - Remplacement des underscores par des espaces
					 * - mise en majuscule de la première lettre de chaque mot
					 */
					$fichier = str_replace('_', ' ', $fichier);
					$fichier = ucwords($fichier);

					// Ajoute le fichier au tableau des résultats
					$results[] = $fichier;
				}
			}

			// Retourne le tableau des résultats
			return $results;
		}
	}
}

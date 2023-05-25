<?php
/**
 * @file UtilsFolderAndFiles.php
 *
 * Ce fichier contient la classe UtilsFolderAndFiles.
 * En cours ...
 *
 * Namespace : Drupal\pdfgenerator\Utils
 *
 * Contains : ...
 */
namespace Drupal\pdfgenerator\Utils;

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
			// Affichage d'un message d'erreur dans le log
			\Drupal::logger('pdfgenerator')->error('[PDF Generator] Le dossier "'.$dossier.'" n\'existe pas.');
			// Affichage d'un message d'erreur dans le log CURL
			\Drupal::logger('pdfgenerator')->error('[PDF Generator] Le dossier "'.$dossier.'" n\'existe pas.', array(), array('channel' => 'curl'));
			//print "Le dossier n'existe pas.";

			// Retourne null
			return null;
		} else {
			// Lit les fichiers dans le dossier
			$fichiers = scandir($dossier);

			// Boucle sur les fichiers
			foreach ($fichiers as $fichier) {
				// Exclut les dossiers '.' et '..'
				if ($fichier != '.' && $fichier != '..') {
					// Vérifie si le chemin correspond à un fichier
					if (is_file($dossier . '/' . $fichier)) {
						// Affichage d'un message dans le log
						\Drupal::logger('pdfgenerator')->notice('[PDF Generator] Le fichier "'.$fichier.'" a été trouvé dans le dossier "'.$dossier.'".');
						// Affichage d'un message dans le log CURL
						\Drupal::logger('pdfgenerator')->notice('[PDF Generator] Le fichier "'.$fichier.'" a été trouvé dans le dossier "'.$dossier.'".', array(), array('channel' => 'curl'));
						// Ajoute le fichier au tableau des résultats
						$results.push($fichier);
					}
				}
			}

			// Retourne le tableau des résultats
			return $results;
		}
	}
}

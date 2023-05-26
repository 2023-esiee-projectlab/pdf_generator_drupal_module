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
namespace Drupal\pdf_generator_drupal_module\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Drupal\pdf_generator_drupal_module\Utils\UtilsFolderAndFiles;
use pdf_generator\PdfGenerator;

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

	public function generatePdfByUrl($url){
		// Vérifiez que la méthode est appelée et que le paramètre est reçu.
		\Drupal::logger('PDF Generator')->notice('yourMethod called with url: ' . $url);

		// Get the current path.
		$current_path = \Drupal::request()->getPathInfo();
		// Get the node id from the current path.
		$node_id = \Drupal::service('path.alias_manager')->getPathByAlias($current_path);
		// Remove all characters except numbers.
		$node_id = preg_replace('/[^0-9]/', '', $node_id);
		// Vérifiez que l'id du noeud est bien récupéré.
		\Drupal::logger('PDF Generator')->notice('yourMethod called with node_id: ' . $node_id);

		// Récupérer le contenu du noeud à partir de son id.
		$node = \Drupal\node\Entity\Node::load($node_id);
		// Vérifiez que le contenu du noeud est bien récupéré.
		\Drupal::logger('PDF Generator')->notice('yourMethod called with node: ' . $node);

		/**
		 * Génerer le PDF à partir du contenu du noeud
		 * avec la classe PdfGenerator
		 * de la librairie esiee/pdf_genereator_composer_package
		 * présente dans le dossier vendor
		 */
		// Création du PDF
		$pdfGenerator = new PdfGenerator();

		// Configuration des informations du PDF
		$pdfGenerator->setPdfInformations(
			'Mon créateur de PDF', // Créateur
			'Moi-même', // Auteur
			'Mon premier PDF avec TCPDF', // Titre
			'Test - création - évènement - maître' // Sujet
		);

		// Configuration du PDF
		$pdfGenerator->setPdfConfig(
			6, // Sauts de ligne
			6 // Interlignes
		);

		// Configuration de TCPDF du PDF
		$pdfGenerator->setPdfConfigTcpdf(
			'P', // Orientation
			'mm', // Unité de mesure
			'A4', // Format
			'UTF-8' // Encodage
		);

		// Activation des bordures et des images
		$pdfGenerator->setPdfConfigTcpdfBorderAndImages(
			true,
			true
		);

		// Activation supplémentaires de TCPDF
		$pdfGenerator->setPdfConfigTcpdfMore(
			false, // Diskcache
			false, //Pdfa
			false //Pdfaauto
		);

		// Configuration du contenu de forme du PDF
		$pdfGenerator->setPdfParametresContenuForme(
			['helvetica', '', 12], // Police
			[20, 20, 20, 20, true] // Marges
		);

		// Configuration du contenu de fond du PDF
		$pdfGenerator->setPdfParametresContenuFond(
			[
				'https://www.sorbonne.fr/wp-content/uploads/ENS_Logo_TL.jpg', // Logo
				30, // Taille du logo
				'ENS', // Créateur
				'https://planet-vie.ens.fr/' // Lien du créateur
			],
			[
				'https://www.sorbonne.fr/wp-content/uploads/ENS_Logo_TL.jpg', // Logo
				30, // Taille du logo
				'ENS', // Créateur
				'https://planet-vie.ens.fr/' // Lien du créateur
			]
		);

		// Configuration des pages de couvertures du PDF
		$pdfGenerator->setPagesCouvertures(
			true, // Page de garde
			true, // Page de séparation
			true, // Page de couverture
			true // Page de fin
		);

		// Configuration des pages du PDF
		$pdfGenerator->setContenu(
			[
				$node
			]
		);

		// Création du PDF
		$pdfGenerator->generatePDF();

		// Success message.
		\Drupal::logger('PDF Generator')->notice('pdf created');
	}
}

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

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\pdf_generator_drupal_module\Utils\UtilsFolderAndFiles;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ErrorException;

// Ancien module de génération de PDF
use TCPDF;
// Futur remplacant de TCPDF
use pdf_generator\PdfGenerator;



/**
 * Print controller.
 */
class PdfGeneratorController extends ControllerBase {

	/**
	 * Validate that the current user has access.
	 *
	 * We need to validate that the user is allowed to access this entity also the
	 * print version.
	 * 
	 * @param string $export_type The export type.
	 * @param string $entity_type  The entity type.
	 * @param int $entity_id The entity id.
	 *
	 * @return \Drupal\Core\Access\AccessResult The access result object.
	 */
	public function checkAccess($export_type, $entity_type, $entity_id) {
		if (empty($entity_id)) {
			return AccessResult::forbidden();
		}

		$account = $this->currentUser();

		// Invalid storage type.
		if (!$this->entityTypeManager->hasHandler($entity_type, 'storage')) {
			return AccessResult::forbidden();
		}

		// Unable to find the entity requested.
		if (!$this->entityTypeManager->getStorage($entity_type)->load($entity_id)) {
			return AccessResult::forbidden();
		}

		return AccessResult::allowed();
	}

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
	public function generatePdf($node_id) {
		// Vérifiez que la méthode est appelée et que le paramètre est reçu.
		\Drupal::logger('PDF Generator')->notice('yourMethod called with node_id: ' . $node_id);

		print 'generatePdf';
	}

	/**
	 * @param string $export_type The export type.
	 * @param string $entity_type  The entity type.
	 * @param int $entity_id The entity id.
	 */
	public function exportPDF($export_type, $entity_type, $entity_id) {
		\Drupal::logger('pdfgenerator')->notice('la liaison marche !');
		return;
		$entity = $this->entityTypeManager->getStorage($entity_type)->load($entity_id);
		if (empty($entity)) {
			throw new ErrorException("No entity found");
		}
		return new Response($this->pdfBuilder->printHtml($entity));
	}

	public function generatePdfByUrl($url) {
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

	// = = = = [ By Chen ] = = = =
	public function exportPdfByChen($node): Response {
		// Vérifiez si le nœud existe et a le type de contenu requis.
		$node = \Drupal::entityTypeManager()->getStorage('node')->load($node);
		if (!$node || ($node->getType() !== 'article' && $node->getType() !== 'article_image')) {
			throw new NotFoundHttpException();
		}
		// Générez le contenu PDF.
		$article = $this->getArticleContentByChen($node);
		$pdfContent = $this->generatePdfByChen($article);

		// Créez une réponse avec le contenu PDF.
		$response = new Response($pdfContent);

		// Configurez les en-têtes appropriés pour le PDF.
		$response->headers->set('Content-Type', 'application/pdf');
		$response->headers->set('Content-Disposition', 'attachment; filename="article.pdf"');

		// Retournez la réponse.
		return $response;
	}

	public function getArticleContentByChen($entity): array {
		// get content
		$title = $entity->getTitle();
		$content = $entity->get('body')->value;

		// Replace &nbsp; entities with spaces.
		$content = str_replace('&nbsp;', ' ', $content);
		// Remove HTML tags from the content.
		$content = strip_tags($content);
		return [
			'title'=>$title,
			'content' => $content,
		];
	}

	private function generatePdfByChen(array $article): string {
		// Generate the PDF content using TCPDF.
		$pdf = new TCPDF();
		$pdf->AddPage();
		$pdf->SetFont('helvetica', '', 12);
		$pdf->Write(0, $article['title'], '', 0, 'L', true, 0, false, false, 0);
		$pdf->Ln(10); // Add some space between title and content
		$pdf->Write(0, $article['content'], '', 0, 'L', true, 0, false, false, 0);

		// Return the PDF content as a string.
		return $pdf->Output('article.pdf', 'S');
	}
}

<?php
/**
 * @file PdfGeneratorBlock.php
 *
 * Ce fichier contient la classe PdfGeneratorBlock.
 * Il permet de gérer le bloc de configuration du module PDF Generator dans l'interface de configuration
 *
 * Namespace : Drupal\pdfgenerator\Form
 *
 * Contains : Drupal\Core\Annotation\Block
 */
namespace Drupal\pdfgenerator\Plugin\Block;

// Permet d'implémenter la classe Block de Drupal pour gérer le bloc de configuration du module PDF Generator dans l'interface de configuration.
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a custom block for PDF Generator configuration.
 *
 * @Block(
 *   id = "pdf_generator_block",
 *   admin_label = "PDF Generator",
 *   category = "PDF Generator"
 * )
 */
class PdfGeneratorBlock extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		// Get the current path.
		$current_path = \Drupal::request()->getPathInfo();
		// Get the node id from the current path.
		$node_id = \Drupal::service('path.alias_manager')->getPathByAlias($current_path);
		// Remove all characters except numbers.
		$node_id = preg_replace('/[^0-9]/', '', $node_id);
		// Get the url of the pdf generator.
		$url = Url::fromRoute('pdfgenerator.generate.pdf', ['node_id' => $node_id]);
		// Create a link to the pdf generator.
		$link = Link::fromTextAndUrl($this->t('Download PDF format'), $url);
		// Convert the link to a renderable array.
		$link = $link->toRenderable();

		$content = [
			// Create a message to display.
			'#markup' => $this->t('Download the article in pdf format.'),
			// Create a button to download the pdf.
			'button' => [
				'#type' => 'submit',
				'#value' => $link['#title'],
				'#url' => $link['#url'],
			],
		];

		return $content;
	}
}

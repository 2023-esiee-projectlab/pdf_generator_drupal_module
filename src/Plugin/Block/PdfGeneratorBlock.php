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
 *   admin_label = "PDF Generator Config Block",
 *   category = "PDF Generator"
 * )
 */
class PdfGeneratorBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
		$url = Url::fromRoute('pdfgenerator.generate.pdf');
		$link = Link::fromTextAndUrl($this->t('Download PDF format'), $url);
		$link = $link->toRenderable();

		$content = [
			'#markup' => $this->t('Download the article in pdf format.'),
			'button' => [
				'#type' => 'submit',
				'#value' => $link['#title'],
				'#url' => $link['#url'],
			],
		];

		return $content;
    }
}

<?php
/**
 * @file PdfGeneratorSettingsBlock.php
 *
 * Ce fichier contient la classe PdfGeneratorSettingsBlock.
 * Il permet de gérer le bloc de configuration du module PDF Generator dans l'interface de configuration
 *
 * Namespace : Drupal\pdfgenerator\Form
 *
 * Contains : Drupal\Core\Annotation\Block
 */
namespace Drupal\pdfgenerator\Block;

// Permet d'implémenter la classe Block de Drupal pour gérer le bloc de configuration du module PDF Generator dans l'interface de configuration.
use Drupal\Core\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom block for PDF Generator configuration.
 *
 * @Block(
 *   id = "pdf_generator_config_block",
 *   admin_label = @Translation("PDF Generator Config Block"),
 *   category = @Translation("PDF Generator")
 * )
 */
@Block;
class PdfGeneratorSettingsBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        return [
            '#markup' => $this->t('This is the PDF Generator configuration block.'),
        ];
    }
}

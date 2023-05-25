<?php

namespace Drupal\pdfgenerator\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use ErrorException;

/**
 * Print controller.
 */
class PdfGeneratorController extends ControllerBase {

	/**
	 * @param string $export_type The export type.
	 * @param string $entity_type  The entity type.
	 * @param int $entity_id The entity id.
	 */
	public function generatePDF($export_type, $entity_type, $entity_id) {
		\Drupal::logger('pdfgenerator')->notice('la liaison marche !');
		return;
		$entity = $this->entityTypeManager->getStorage($entity_type)->load($entity_id);
		if (empty($entity)) {
			throw new ErrorException("No entity found");
		}
		return new Response($this->printBuilder->printHtml($entity));
	}

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
}

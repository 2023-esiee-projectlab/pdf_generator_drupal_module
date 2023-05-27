<?php

namespace Drupal\pdf_generator_drupal_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for the permissions page.
 */
class PermissionController extends ControllerBase {

	/**
	 * Displays the permissions page.
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 *   The permissions page.
	 */
	public function permissionsPage() {
		// Replace 'mon_module' with your module's machine name.
		$permissions_output = \Drupal::moduleHandler()->invoke('pdf_generator_drupal_module', 'permission');

		// Merge and render the output from all modules implementing the hook.
		$output = '';
		foreach ($permissions_output as $module_permissions) {
			$output .= $module_permissions;
		}

		return new Response($output);
	}

}
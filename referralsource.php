<?php

require_once 'referralsource.civix.php';
// phpcs:disable
use CRM_Referralsource_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_postProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postProcess
 */
function referralsource_civicrm_postProcess($formName, &$form) {
  // Detect contribution page and contribution confirm page
  if ($formName === 'CRM_Contribute_Form_Contribution_Confirm') {
    // Get the source param by the entryURL in the controler array
    $controller = $form->getVar('controller');
    // Process to get the source param
    $params = explode('?', $controller->_entryURL);
    parse_str(end($params), $parseURL);

    foreach ($parseURL as $key => $value) {
      // Remove amp; since it was not remove using parse_str
      $newKey = str_replace('amp;', '', $key);

      if ($newKey === 'source') {
        // Get the newly created contribution
        $lastContribution = civicrm_api3('Contribution', 'get', [
          'sequential' => 1,
          'id' => $form->_contributionID,
          'return' => ['id', 'contribution_source'],
        ]);

        // Add the source param value to the current source
        $newSource = $lastContribution['values'][0]['contribution_source'] . ' - ' . $value;

        // Update the source
        $result = civicrm_api3('Contribution', 'create', [
          'id' => $form->_contributionID,
          'source' => $newSource,
        ]);

        break;
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function referralsource_civicrm_config(&$config) {
  _referralsource_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function referralsource_civicrm_xmlMenu(&$files) {
  _referralsource_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function referralsource_civicrm_install() {
  _referralsource_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function referralsource_civicrm_postInstall() {
  _referralsource_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function referralsource_civicrm_uninstall() {
  _referralsource_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function referralsource_civicrm_enable() {
  _referralsource_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function referralsource_civicrm_disable() {
  _referralsource_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function referralsource_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _referralsource_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function referralsource_civicrm_managed(&$entities) {
  _referralsource_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function referralsource_civicrm_caseTypes(&$caseTypes) {
  _referralsource_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function referralsource_civicrm_angularModules(&$angularModules) {
  _referralsource_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function referralsource_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _referralsource_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function referralsource_civicrm_entityTypes(&$entityTypes) {
  _referralsource_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function referralsource_civicrm_themes(&$themes) {
  _referralsource_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function referralsource_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function referralsource_civicrm_navigationMenu(&$menu) {
//  _referralsource_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _referralsource_civix_navigationMenu($menu);
//}

<?php

/**
 * Adds template suggestion for node and css class depending on node's id.
 *
 * Default template: node.tpl.php.
 *
 * @param array $variables
 *   An associative array containing:
 *   - node: A stdClass object containing the properties of the node.
 *     Properties used: nid.
 *   - theme_hook_suggestions: An array of template's names.
 *   - classes_array: An associative array of css classes.
 *   - view_mode: A string represents current view mode for page.
 */
function roman_tsepenev_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    if (_roman_tselepnev_is_node_even($variables['node'])) {
      $variables['theme_hook_suggestions'][] = 'node__even';
      $variables['classes_array'][] = 'node-even-roman';
    }
    else {
      $variables['theme_hook_suggestions'][] = 'node__odd';
      $variables['classes_array'][] = 'node-odd-roman';
    }
  }
}

/**
 * Defines whether node has even or odd nid.
 *
 * @param \stdClass $node
 *   Node object.
 *
 * @return bool
 *   Returns true if node has even nid or false otherwise.
 */
function _roman_tselepnev_is_node_even($node) {
  return (($node->nid % 2) === 0);
}

/**
 * Build page title section.
 *
 * @param array $variables
 *   An associative array containing:
 *   - title: current page title.
 */
function roman_tsepenev_process_page(&$variables){
  if (isset($variables['title'])) {
    $variables['roman_title_array'] = array(
      '#type' => 'html_tag',
      '#tag' => 'h1',
      '#value' => $variables['title'],
      '#attributes' => array(
        'class' => ['title'],
        'id' => 'page-title',
      ),
    );
    if (isset($variables['node']) && node_is_page($variables['node'])) {
      if (_roman_tselepnev_is_node_even($variables['node'])) {
        $variables['roman_title_array']['#tag'] = 'h3';
        $variables['roman_title_array']['#attributes']['class'][] = 'roman-green';
      }
      else {
        $variables['roman_title_array']['#attributes']['class'][] = 'roman-red';
      }
    }
  }
}

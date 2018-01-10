<?php

/**
 * Adds template suggestion for node and css class depending on node's id.
 */
function roman_tsepenev_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    if (_roman_tselepnev_is_node_even($variables['node'])){
      $variables['theme_hook_suggestions'][] = 'node__even';
      $variables['classes_array'][] = 'node-even-roman';
    }
    else {
      $variables['theme_hook_suggestions'][] = 'node__odd';
      $variables['classes_array'][] = 'node-odd-roman';
    }
  }
}

function _roman_tselepnev_is_node_even($node){
  return (($node->nid % 2) === 0);
}

/**
 * Build page title section.
 *
 * @param $variables
 */
function roman_tsepenev_process_page(&$variables){
  if (isset($variables['title'])){
     $variables['roman_title_array'] = array(
       '#type' => 'html_tag',
       '#tag' => 'h1',
       '#value' => $variables['title'],
       '#attributes' => array(
         'class' => ['title'],
         'id' => 'page-title'
       ),
     );

     if (isset($variables['node']) && node_is_page($variables['node'])){
       if (_roman_tselepnev_is_node_even($variables['node'])){
         $variables['roman_title_array']['#tag'] = 'h3';
         $variables['roman_title_array']['#attributes']['class'][] = 'roman-green';
       }
       else {
         $variables['roman_title_array']['#attributes']['class'][] = 'roman-red';
       }
     }
  }
}

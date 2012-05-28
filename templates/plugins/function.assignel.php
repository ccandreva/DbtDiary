<?php
function smarty_function_assignel ($_params, &$_smarty)
{
    if (!isset($_params['var'])) {
        $_smarty->trigger_error("assignel: missing 'var' parameter", E_USER_ERROR, __FILE__, __LINE__);
        return;
    }
   
   if (!isset($_params['key'])) {
        $_smarty->trigger_error("assignel: missing 'key' parameter", E_USER_ERROR, __FILE__, __LINE__);
        return;
    }
   
   if (!isset($_params['value'])) {
        $_smarty->trigger_error("assignel: missing 'value' parameter", E_USER_ERROR, __FILE__, __LINE__);
        return;
    }
   
   if (isset($_smarty->_tpl_vars[$_params['var']]) && is_array($_smarty->_tpl_vars[$_params['var']])) {
      $var = $_smarty->_tpl_vars[$_params['var']];
   } else {
      $var = array();
   }
   
   $var[$_params['key']] = $_params['value'];
   
   $_smarty->assign($_params['var'], $var);
} 
?>

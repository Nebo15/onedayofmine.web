<?php 
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */ 

/**
 * class lmbMacroDefaultFilter.
 *
 * @filter default
 * @package macro
 * @version $Id$
 */ 
class lmbMacroDefaultFilter extends lmbMacroFunctionBasedFilter
{
  protected $function = 'lmb_macro_apply_default';
  protected $include_file = 'limb/macro/src/filters/lmbMacroDefaultFilter.inc.php';
	protected $value_var_name;

	/**
	 * @param lmbMacroCodeWriter $code
	 */
	function preGenerate($code)
	{
		parent :: preGenerate($code);
		$this->value_var_name = $code->generateVar();
		$code->writePHP($this->value_var_name.' = '.parent::_getBaseValue().'; ');
	}

  protected function _getBaseValue()
  {
    return "isset({$this->value_var_name}) ? {$this->value_var_name} : null";
  }
} 

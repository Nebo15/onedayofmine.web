<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package imagekit
 */
class lmbImageKit
{
  /**
   * @static
   * @param string $library
   * @param string $dir
   * @param array $params
   * @return lmbAbstractImageConverter
   * @throws lmbFileNotFoundException
   */
  static function create($library = 'gd', $dir = '', $params = array())
  {
    $image_class_name = 'lmb' . ucfirst($library) . 'ImageConverter';

    $class_path = 'limb/imagekit/src/' .  $library . '/' . $image_class_name . '.class.php';

    lmb_require($class_path);

    try {
      $converter = new $image_class_name($params);
    }
    catch (lmbException $e)
    {
      throw new lmbFileNotFoundException($class_path, 'image library not found');
    }

    return $converter;
  }

  /**
   * @static
   * @param $file_name
   * @param string $type
   * @param string $library
   * @param string $dir
   * @param array $params
   * @return lmbAbstractImageConverter
   */
  static function load($file_name, $type = '', $library = 'gd', $dir = '', $params = array())
  {
  	$converter = self::create($library, $dir, $params);
    $converter->load($file_name, $type);
    return $converter;
  }

}

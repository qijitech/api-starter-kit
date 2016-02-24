<?php
namespace Api\StarterKit\Enums;

use ReflectionClass;

abstract class Enum
{

  /**
   * @return array
   */
  public static function getKeys()
  {
    $class = new ReflectionClass(get_called_class());
    return array_keys($class->getConstants());
  }

  public static function isValidValue($value)
  {
    $values = array_values(self::getConstants());
    return in_array($value, $values, $strict = true);
  }

  public static function getCode($label, $isLower = false)
  {
    $class = new ReflectionClass(get_called_class());
    $constants = $class->getConstants();
    if ($isLower) {
      return $constants[strtoupper($label)];
    }
    return $constants[$label];
  }

  public static function getLabel($code, $isLower = false)
  {
    $class = new ReflectionClass(get_called_class());
    $constants = $class->getConstants();
    $constants = array_flip($constants);
    if ($isLower) {
      return strtolower($constants[$code]);
    }
    return $constants[$code];
  }
}
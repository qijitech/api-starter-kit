<?php namespace Api\StarterKit\Utils;

class Constants
{

  /**
   * Get the since-id parameter key
   * @return mixed
   */
  public static function getParameterKeySinceId()
  {
    return config('consts.ParameterSinceId');
  }

  /**
   * Get the max-id parameter key
   * @return mixed
   */
  public static function getParameterKeyMaxId()
  {
    return config('consts.ParameterMaxId');
  }

  /**
   * Get the token parameter key
   * @return mixed
   */
  public static function getParameterKeyToken()
  {
    return config('consts.ParameterToken');
  }

  /**
   * Get the account id parameter key
   * @return mixed
   */
  public static function getParameterKeyAccountId()
  {
    return config('consts.ParameterAccountId');
  }

  /**
   * Get the page parameter key
   * @return mixed
   */
  public static function getParameterKeyPage()
  {
    return config('consts.ParameterPage');
  }

  /**
   * Get the page size parameter key
   * @return mixed
   */
  public static function getParameterKeyPageSize()
  {
    return config('consts.ParameterPageSize');
  }

  /**
   * Get the default page
   * @return mixed
   */
  public static function getDefaultPage()
  {
    return config('consts.DefaultPage');
  }

  /**
   * get the default page size
   * @return mixed
   */
  public static function getDefaultLimit()
  {
    return config('consts.DefaultLimit');
  }
}
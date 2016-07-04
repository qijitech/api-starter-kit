<?php namespace Api\StarterKit\Traits;

use Api\StarterKit\Utils\Constants;
use Illuminate\Http\Request;

trait ParamTraits
{

  /**
   * @var Request
   */
  protected $request;

  public function inputGet($key, $default = null)
  {
    return $this->request->get($key, $default);
  }

  public function inputAll()
  {
    return $this->request->all();
  }

  public function getIdParams()
  {
    return [$this->getSinceId(), $this->getMaxId()];
  }

  public function getPageParams()
  {
    return [$this->getPage(), $this->getPageSize()];
  }

  /**
   * @return mixed
   */
  public function getSinceId()
  {
    return $this->inputGet(Constants::getParameterKeySinceId());
  }

  /**
   * @return mixed
   */
  public function getMaxId()
  {
    return $this->inputGet(Constants::getParameterKeyMaxId());
  }

  /**
   * 获取当前页面大小
   * @return mixed
   */
  public function getPageSize()
  {
    return $this->inputGet(Constants::getParameterKeyPageSize(), Constants::getDefaultPageSize());
  }

  /**
   * 获取当前页
   * @return mixed
   */
  public function getPage()
  {
    return $this->inputGet(Constants::getParameterKeyPage(), Constants::getDefaultPage());
  }

}
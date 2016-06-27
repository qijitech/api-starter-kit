<?php namespace Api\StarterKit\Controllers;

use Api\StarterKit\Utils\ApiResponse;
use Api\StarterKit\Utils\ApiValidatesRequests;
use Api\StarterKit\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{

  use ApiValidatesRequests;
  use ApiResponse;

  /**
   * @param Request $request
   * @return mixed
   */
  public function getSinceId(Request $request)
  {
    return $request->get(Constants::getParameterKeySinceId());
  }

  /**
   * @param Request $request
   * @return mixed
   */
  public function getMaxId(Request $request)
  {
    return $request->get(Constants::getParameterKeyMaxId());
  }

  /**
   * 获取当前页面大小
   * @param Request $request
   * @return mixed
   */
  public function getPageSize(Request $request)
  {
    return $request->get(Constants::getParameterKeyPageSize(), Constants::getDefaultLimit());
  }

  /**
   * 获取当前页
   * @param Request $request
   * @return mixed
   */
  public function getPage(Request $request)
  {
    return $request->get(Constants::getParameterKeyPage(), Constants::getDefaultPage());
  }

}
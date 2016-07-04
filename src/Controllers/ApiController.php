<?php namespace Api\StarterKit\Controllers;

use Api\StarterKit\Traits\ParamTraits;
use Api\StarterKit\Utils\ApiResponse;
use Api\StarterKit\Utils\ApiValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{

  use ApiValidatesRequests;
  use ApiResponse;
  use ParamTraits;

  /**
   * ApiController constructor.
   */
  public function __construct()
  {
    $this->request = app(Request::class);
  }

}
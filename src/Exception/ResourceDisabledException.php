<?php namespace Api\StarterKit\Exception;

use Dingo\Api\Exception\ResourceException;

class ResourceDisabledException extends ResourceException
{

  /**
   * DisabledResourceException constructor.
   * @param null|string $message
   */
  public function __construct($message = 'Resource Disabled')
  {
    parent::__construct($message);
  }

}
<?php namespace Api\StarterKit\Utils;

use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

trait ApiValidatesRequests
{

  /**
   * Validate the given request with the given rules.
   *
   * @param  Request $request
   * @param  array $rules
   * @param  array $messages
   * @param  array $customAttributes
   * @return void
   */
  public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
  {
    $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

    if ($validator->fails()) {
      throw new ValidationHttpException($this->formatValidationErrors($validator));
    }
  }

  /**
   * Format the validation errors to be returned.
   *
   * @param  Validator $validator
   * @return array
   */
  protected function formatValidationErrors(Validator $validator)
  {
    return $validator->errors()->getMessages();
  }


  /**
   * Get a validation factory instance.
   *
   * @return \Illuminate\Contracts\Validation\Factory
   */
  protected function getValidationFactory()
  {
    return app('validator');
  }

}
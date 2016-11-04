<?php

use Api\StarterKit\Transformers\SimpleTransformer;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\Response;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;
use League\Fractal\TransformerAbstract;

if (!function_exists('parameterKeySinceId')) {
  /**
   * Get the since_id parameter key
   * @return mixed
   */
  function parameterKeySinceId()
  {
    return config('consts.ParameterSinceId');
  }
}

if (!function_exists('parameterKeyMaxId')) {
  /**
   * Get the max_id parameter key
   * @return mixed
   */
  function parameterKeyMaxId()
  {
    return config('consts.ParameterMaxId');
  }
}

if (!function_exists('parameterKeyToken')) {

  /**
   * Get the token parameter key
   * @return mixed
   */
  function parameterKeyToken()
  {
    return config('consts.ParameterToken');
  }
}

if (!function_exists('parameterKeyAccountId')) {
  /**
   * Get the account id parameter key
   * @return mixed
   */
  function parameterKeyAccountId()
  {
    return config('consts.ParameterAccountId');
  }
}

if (!function_exists('parameterKeyPage')) {
  /**
   * Get the page parameter key
   * @return mixed
   */
  function parameterKeyPage()
  {
    return config('consts.ParameterPage');
  }
}

if (!function_exists('parameterKeyPageSize')) {
  /*
 * Get the page size parameter key
 * @return mixed
 */
  function parameterKeyPageSize()
  {
    return config('consts.ParameterPageSize');
  }
}

if (!function_exists('defaultPage')) {
  /**
   * Get the default page
   * @return mixed
   */
  function defaultPage()
  {
    return config('consts.DefaultPage');
  }
}

if (!function_exists('defaultPageSize')) {
  /**
   * get the default page size
   * @return mixed
   */
  function defaultPageSize()
  {
    return config('consts.DefaultPageSize');
  }
}

if (!function_exists('request')) {

  /**
   * @return Illuminate\Http\Request
   */
  function request()
  {
    return app('Illuminate\Http\Request');
  }
}

if (!function_exists('inputAll')) {
  /**
   * @return array
   */
  function inputAll()
  {
    return request()->all();
  }
}

if (!function_exists('inputGet')) {
  /**
   * @param $key
   * @param null $default
   * @return mixed
   */
  function inputGet($key, $default = null)
  {
    return request()->get($key, $default);
  }
}

if (!function_exists('pageSize')) {
  /**
   * 获取当前页面大小
   * @return mixed
   */
  function pageSize()
  {
    return inputGet(parameterKeyPageSize(), defaultPageSize());
  }
}

if (!function_exists('currentPage')) {
  /**
   * 获取当前页
   * @return mixed
   */
  function currentPage()
  {
    return inputGet(parameterKeyPage(), defaultPage());
  }
}

if (!function_exists('pageParams')) {
  function pageParams()
  {
    return [currentPage(), pageSize()];
  }
}

if (!function_exists('maxId')) {
  function maxId()
  {
    return inputGet(parameterKeyMaxId());
  }
}

if (!function_exists('sinceId')) {
  function sinceId()
  {
    return inputGet(parameterKeySinceId());
  }
}

if (!function_exists('idParams')) {
  function idParams()
  {
    return [sinceId(), maxId()];
  }
}

if (!function_exists('pageSize')) {
  /**
   * 获取当前页
   * @return mixed
   */
  function pageSize()
  {
    return inputGet(parameterKeyPage(), defaultPage());
  }
}

if (!function_exists('user()')) {
  function user()
  {
    return app('Dingo\Api\Auth\Auth')->user();
  }
}

if (!function_exists('bcrypt')) {
  /**
   * Hash the given value.
   *
   * @param  string $value
   * @param  array $options
   * @return string
   */
  function bcrypt($value, $options = [])
  {
    return app('hash')->make($value, $options);
  }
}

if (!function_exists('trans')) {
  /**
   * Translate the given message.
   *
   * @param  string $id
   * @param  array $parameters
   * @param  string $domain
   * @param  string $locale
   * @return \Symfony\Component\Translation\TranslatorInterface|string
   */
  function trans($id = null, $parameters = [], $domain = 'messages', $locale = null)
  {
    if (is_null($id)) {
      return app('translator');
    }

    return app('translator')->trans($id, $parameters, $domain, $locale);
  }
}

if (!function_exists('trans_choice')) {
  /**
   * Translates the given message based on a count.
   *
   * @param  string $id
   * @param  int|array|\Countable $number
   * @param  array $parameters
   * @param  string $domain
   * @param  string $locale
   * @return string
   */
  function trans_choice($id, $number, array $parameters = [], $domain = 'messages', $locale = null)
  {
    return app('translator')->transChoice($id, $number, $parameters, $domain, $locale);
  }
}


// Response func

if (!function_exists('dingoResponse')) {
  /**
   * @return \Dingo\Api\Http\Response\Factory
   */
  function dingoResponse()
  {
    return app('Dingo\Api\Http\Response\Factory');
  }
}

if (!function_exists('respondError')) {
  /**
   * @param $message
   * @param $statusCode
   */
  function respondError($message, $statusCode)
  {
    dingoResponse()->error($message, $statusCode);
  }
}

if (!function_exists('respondSuccess')) {
  function respondSuccess($message = 'Success')
  {
    $data = [
      'message'     => $message,
      'status_code' => Response::HTTP_OK,
    ];
    return (new Response($data))->setStatusCode(Response::HTTP_OK);
  }
}

if (!function_exists('respondForbidden')) {
  function respondForbidden($message = 'Forbidden')
  {
    respondError($message, 403);
  }
}

if (!function_exists('errorInternal')) {
  function respondInternal($message = 'Internal Server Error!')
  {
    respondError($message, 500);
  }
}

if (!function_exists('errorUnauthorized')) {
  function errorUnauthorized($message = 'Unauthorized')
  {
    respondError($message, 401);
  }
}

if (!function_exists('respondNotFound')) {
  function respondNotFound($message = 'Not Found!')
  {
    respondError($message, 404);
  }
}

if (!function_exists('respondCreated')) {
  function respondCreated($location = null, $content = null)
  {
    return dingoResponse()->created($location, $content);
  }
}

if (!function_exists('respondUnprocessable')) {
  function respondUnprocessable($message)
  {
    respondError($message, Response::HTTP_UNPROCESSABLE_ENTITY);
  }
}

if (!function_exists('respondWithItem')) {
  function respondWithItem($data, TransformerAbstract $transformer = null)
  {
    return dingoResponse()->item($data, getTransformer($transformer));
  }
}

if (!function_exists('respondWithArray')) {
  function respondWithArray($data)
  {
    return dingoResponse()->array($data);
  }
}

if (!function_exists('respondWithCollection')) {
  /**
   * @param Collection $data
   * @param TransformerAbstract|null $transformer
   * @return Response
   */
  function respondWithCollection(Collection $data, TransformerAbstract $transformer = null)
  {
    return dingoResponse()->collection($data, getTransformer($transformer));
  }
}

if (!function_exists('respondWithPagination')) {
  /**
   * @param Paginator $paginator
   * @return Response
   */
  function respondWithPagination(Paginator $paginator)
  {
    return array_except($paginator->toArray(), ['next_page_url', 'prev_page_url', 'from', 'to']);
  }
}

if (!function_exists('getTransformer')) {
  function getTransformer(TransformerAbstract $transformer = null)
  {
    return $transformer ? $transformer : new SimpleTransformer;
  }
}

// Validate
if (!function_exists('validationFactory')) {

  /**
   * Get a validation factory instance.
   *
   * @return Factory
   */
  function validationFactory()
  {
    return app('validator');
  }
}

if (!function_exists('formatValidationErrors')) {

  /**
   * @param Validator $validator
   * @return array
   */
  function formatValidationErrors(Validator $validator)
  {
    return $validator->errors()->getMessages();
  }
}

if (!function_exists('validate')) {
  function validate(array $rules, array $messages = [], array $customAttributes = [])
  {
    /** @var Validator $validator */
    $validator = validationFactory()->make(request()->all(), $rules, $messages, $customAttributes);
    if ($validator->fails()) {
      throw new ValidationHttpException(formatValidationErrors($validator));
    }
  }
}

if (!function_exists('morphKey')) {
  /**
   * @param Builder $builder
   * @param string $key
   * @return Builder
   */
  function morphKey($builder, $key = 'id')
  {
    $maxId = maxId();
    $sinceId = sinceId();
    if ($maxId) {
      $builder->where($key, '<', $maxId);
    } else if ($sinceId) {
      $builder->where($key, '>', $sinceId);
    }
    return $builder->take(pageSize());
  }
}

if (!function_exists('morphPage')) {
  /**
   * @param Builder $builder
   * @param array $columns
   * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
   */
  function morphPage($builder, $columns = ['*'])
  {
    return $builder->forPage(currentPage(), pageSize())->select($columns);
  }
}
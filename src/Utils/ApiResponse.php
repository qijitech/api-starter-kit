<?php
namespace Api\StarterKit\Utils;


use Api\StarterKit\Transformers\SimpleTransformer;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

trait ApiResponse
{

  use Helpers;

  protected $statusCode = 200;

  /**
   * @return int
   */
  public function getStatusCode()
  {
    return $this->statusCode;
  }

  /**
   * @param int $statusCode
   * @return $this
   */
  public function setStatusCode($statusCode)
  {
    $this->statusCode = $statusCode;

    return $this;
  }

  /**
   * @param string $message
   * @return mixed
   */
  public function respondForbidden($message = 'Forbidden!')
  {
    $this->response()->errorForbidden($message);
  }

  /**
   * @param string $message
   * @return mixed
   */
  public function respondInternal($message = 'Internal Server Error!')
  {
    $this->response()->errorInternal($message);
  }

  /**
   * @param string $message
   * @return mixed
   */
  public function respondMethodNotAllowed($message = 'Method Not Allowed!')
  {
    $this->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED)
      ->response()->error($message, $this->getStatusCode());
  }

  /**
   * @param string $message
   * @return mixed
   */
  public function respondBadMethod($message = 'Bad Method!')
  {
    $this->response()->errorBadRequest($message);
  }

  /**
   * @param string $message
   * @return mixed
   */
  public function respondNotFound($message = 'Not Found!')
  {
    $this->response()->errorNotFound($message);
  }

  /**
   * @param $message
   * @return mixed
   */
  public function respondSuccess($message = 'Success')
  {
    $this->setStatusCode(Response::HTTP_OK)
      ->response()->error($message, $this->getStatusCode());
  }

  /**
   * @param $location
   * @return mixed
   */
  public function respondCreated($location = null)
  {
    $this->response()->created($location);
  }

  /**
   * @param $message
   * @return mixed
   */
  public function respondUnprocessable($message)
  {
    $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
      ->response()->error($message, $this->getStatusCode());
  }

  /**
   * @param $data
   * @param TransformerAbstract $transformer
   * @return mixed
   */
  public function respondWithItem($data, TransformerAbstract $transformer = null)
  {
    return $this->response()->item($data, $this->getTransformer($transformer));
  }

  /**
   * @param Collection $data
   * @param TransformerAbstract $transformer
   * @return mixed
   */
  public function respondWithCollection(Collection $data, TransformerAbstract $transformer = null)
  {
    return $this->response()->collection($data, $this->getTransformer($transformer));
  }

  /**
   * @param AbstractPaginator $paginator
   * @param TransformerAbstract $transformer
   * @return mixed
   */
  public function respondWithPagination(AbstractPaginator $paginator, TransformerAbstract $transformer = null)
  {
    return $this->respondWithCollection($paginator->getCollection(), $transformer);
  }

  /**
   * get transformer
   * @param TransformerAbstract|null $transformer
   * @return SimpleTransformer|TransformerAbstract
   */
  private function getTransformer(TransformerAbstract $transformer = null)
  {
    return $transformer ? $transformer : new SimpleTransformer;
  }
}
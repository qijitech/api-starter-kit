<?php
/**
 * Created by PhpStorm.
 * User: YuGang Yang
 * Date: 1/13/16
 * Time: 11:52 AM
 */

namespace Api\StarterKit\Serializer;


use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\ArraySerializer;

class ApiSerializer extends ArraySerializer
{
  /**
   * Serialize a collection.
   *
   * @param string $resourceKey
   * @param array $data
   *
   * @return array
   */
  public function collection($resourceKey, array $data)
  {
    if ($resourceKey) {
      return [$resourceKey => $data];
    }
    return $data;
  }

  /**
   * Serialize an item.
   *
   * @param string $resourceKey
   * @param array $data
   *
   * @return array
   */
  public function item($resourceKey, array $data)
  {
    if ($resourceKey) {
      return [$resourceKey => $data];
    }
    return $data;
  }

  /**
   * Serialize the paginator.
   *
   * @param PaginatorInterface $paginator
   *
   * @return array
   */
  public function paginator(PaginatorInterface $paginator)
  {
    $currentPage = (int)$paginator->getCurrentPage();
    $lastPage = (int)$paginator->getLastPage();

    $pagination = [
      'total'        => (int)$paginator->getTotal(),
      'count'        => (int)$paginator->getCount(),
      'per_page'     => (int)$paginator->getPerPage(),
      'current_page' => $currentPage,
      'total_pages'  => $lastPage,
      'has_more'     => $currentPage < $lastPage,
    ];

    return ['pagination' => $pagination];
  }
}
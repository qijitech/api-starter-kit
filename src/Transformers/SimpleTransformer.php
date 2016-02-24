<?php
namespace Api\StarterKit\Transformers;

use League\Fractal\TransformerAbstract;

class SimpleTransformer extends TransformerAbstract
{

  /**
   * @param $item
   * @return array
   */
  public function transform($item)
  {
    return $item->toArray();
  }

}
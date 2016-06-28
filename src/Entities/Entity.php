<?php namespace Api\StarterKit\Entity;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{

  /**
   * @return int
   */
  public function getCreatedAtAttribute()
  {
    $time = strtotime($this->attributes['created_at']);
    return $time == false ? 0 : $time;
  }

}
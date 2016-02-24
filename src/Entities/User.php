<?php

namespace Api\StarterKit\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Entity implements
  AuthenticatableContract,
  AuthorizableContract
{
  use Authenticatable, Authorizable;
}
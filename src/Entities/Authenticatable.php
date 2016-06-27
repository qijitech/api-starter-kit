<?php namespace Api\StarterKit\Enums;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Entity implements
  AuthenticatableContract,
  AuthorizableContract,
  CanResetPasswordContract
{
  use Authenticatable, Authorizable, CanResetPassword;
}
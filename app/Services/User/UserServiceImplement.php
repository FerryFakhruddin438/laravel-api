<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServiceImplement extends Service implements UserService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(UserRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Define your custom methods :)

  public function login(array $payload)
  {
    $user = $this->mainRepository->findBy('email', $payload['email']);
    if ($user && Hash::check($payload['password'], $user->password)) {
      Auth::login($user);
      $token = $user->createToken('authToken')->plainTextToken;
      return $token;
    }
    return false;
  }
}

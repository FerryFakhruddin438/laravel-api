<?php

namespace App\Services\Book;

use LaravelEasyRepository\Service;
use App\Repositories\Book\BookRepository;

class BookServiceImplement extends Service implements BookService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(BookRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Define your custom methods :)
  public function store(array $payload)
  {
    return $this->mainRepository->store($payload);
  }
}

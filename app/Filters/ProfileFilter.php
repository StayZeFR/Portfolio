<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

}
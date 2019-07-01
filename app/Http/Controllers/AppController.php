<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\Factory as ViewFactory;

class AppController
{
    /**
     * @var View
     */
    private $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    public function index ()
    {
        return $this->view->make('app');
    }

    public function login()
    {
        return $this->view->make('auth');
    }
}
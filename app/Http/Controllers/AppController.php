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

    /**
     * Страница приложения
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->view->make('app');
    }

    /**
     * Страница авторизации
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return $this->view->make('auth');
    }
}
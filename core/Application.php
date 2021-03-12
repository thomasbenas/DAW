<?php

namespace app\core;

class Application
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router): void
    {
        $this->router = $router;
    }


}
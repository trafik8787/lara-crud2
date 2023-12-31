<?php

namespace Trafik8787\laraCrud2\Models;

use Illuminate\Routing\Route;
use Trafik8787\laraCrud2\Contracts\Model\ModelRouterInterface;

class ModelRouter implements ModelRouterInterface
{

    private $route;

    public function __construct (Route $route) {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }
}

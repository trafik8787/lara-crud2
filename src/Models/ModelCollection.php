<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.08.2017
 * Time: 19:10
 */

namespace Trafik8787\LaraCrud2\Models;


use Illuminate\Support\Collection;
use Trafik8787\LaraCrud2\Contracts\NodeModelConfigurationInterface;

class ModelCollection extends Collection
{
    /**
     * @return static
     */
    public function aliases()
    {
        return $this->map(function (NodeModelConfigurationInterface $model) {
            return $model->getAlias();
        });
    }


    /**
     * @return static
     */
    public function keyByAlias()
    {
        return $this->keyBy(function (NodeModelConfigurationInterface $model) {
            return $model->getAlias();
        });
    }

}

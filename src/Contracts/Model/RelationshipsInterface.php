<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 12.10.2017
 * Time: 17:42
 */

namespace Trafik8787\LaraCrud2\Contracts\Model;

interface RelationshipsInterface
{

    /**
     * @return mixed
     */
    public function OneToOne();

    /**
     * @return mixed
     */
    public function OneToMany();

    /**
     * @return mixed
     */
    public function ManyToMany();


}

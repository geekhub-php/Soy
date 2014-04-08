<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 03.04.14
 * Time: 21:06
 */

namespace Soy\Bundle\SoyBundle\Entity;


class Search
{
    private $request;

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
} 
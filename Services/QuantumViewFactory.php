<?php

namespace Octante\UpsAPIBundle\Services;

/*
 * This file is part of the UpsAPIBundle package.
 *
 * (c) Issel Guberna <issel.guberna@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Octante\UpsAPIBundle\Library\QuantumViewWrapper;
use Ups\RequestInterface;

class QuantumViewFactory
{
    /**
     * Return a new instance of Shipping wrapper class.
     *
     * @return QuantumViewWrapper
     */
    public static function create(
        $accessKey,
        $userId,
        $password,
        $logger,
        $useIntegration = false,
        $requestClass = null
    ){
        $request = self::getRequest($requestClass);

        return new QuantumViewWrapper(
            new \Ups\QuantumView(
                $accessKey,
                $userId,
                $password,
                $useIntegration,
                $request,
                $logger
            )
        );
    }

    /**
     * @return RequestInterface
     */
    private static function getRequest($requestClass)
    {
        $request = null;
        if ($requestClass != '') {
            $request = new $requestClass();
        }

        return $request;
    }
}

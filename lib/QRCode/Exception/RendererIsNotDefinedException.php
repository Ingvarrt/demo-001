<?php

namespace Ing\QRCode\Exception;

class RendererIsNotDefinedException extends RuntimeException
{
    /**
     * @var string
     */
    protected $message = 'Renderer is not defined';
}

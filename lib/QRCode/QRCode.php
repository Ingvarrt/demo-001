<?php

namespace Ing\QRCode;

use Ing\QRCode\Exception\RendererIsNotDefinedException;
use Ing\QRCode\Renderer\RendererInterface;

class QRCode
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @param string $text
     * @param int $width
     * @param int $height
     */
    public function __construct($text, $width, $height)
    {
        $this->text = (string) $text;
        $this->width = (int) $width;
        $this->height = (int) $height;
    }

    /**
     * @return RendererInterface
     * @throws RendererIsNotDefinedException
     */
    private function getRenderer()
    {
        if (empty($this->renderer)) {
            throw new RendererIsNotDefinedException();
        }

        return $this->renderer;
    }

    /**
     * Sets and configures renderer.
     * @param RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $renderer
            ->setText($this->text)
            ->setWidth($this->width)
            ->setHeight($this->height)
        ;

        $this->renderer = $renderer;
    }

    /**
     * @return string
     * @throws RendererIsNotDefinedException
     */
    public function generate()
    {
        return $this->getRenderer()->render();
    }
}

<?php

namespace Ing\QRCode\Renderer;

interface RendererInterface
{
    /**
     * @return string
     */
    public function render();

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text);

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width);

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height);
}

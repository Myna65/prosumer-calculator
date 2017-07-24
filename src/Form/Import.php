<?php


namespace Myna65\ProsumerCalculator\Form;


class Import {

    /**
     * @var string
     */
    private $file;

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return Import
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }



}
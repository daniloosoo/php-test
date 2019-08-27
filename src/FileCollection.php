<?php

namespace Live\Collection;

/**
 * File collection
 *
 * @package Live\Collection
 */

class FileCollection implements CollectionInterface
{
    /**
     * Collection data
     *
     * @var array
     */
    public $name;
    protected $data;

    /**
     * Constructor
     */
    public function __construct($filename = null)
    {
        if (is_null($filename)) {
            $this->data = [];
            $this->name = null;
        } else {
            $this->data = fopen($_SERVER['DOCUMENT_ROOT'] . $filename . '.txt', 'w');
            $this->name = $filename;
        }
    }

//    /**
//     * {@inheritDoc}
//     */
//    public function get(string $index, $defaultValue = null)
//    {
//        if (!$this->has($index)) {
//            return $defaultValue;
//        }
//
//        return $this->data[$index];
//    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value)
    {
        if (is_array($value)) {
            for ($i = 0; $i < count($value); $i++) {
                fwrite($this->data, $index . ' ' . $value[$i] . PHP_EOL);
            }
        } else {
            fwrite($this->data, $index . ' ' . $value . PHP_EOL);
        }
    }

//    /**
//     * {@inheritDoc}
//     */
//    public function has(string $index)
//    {
//        return array_key_exists($index, $this->data);
//    }

//    /**
//     * {@inheritDoc}
//     */
//    public function count(): int
//    {
//        return count($this->data);
//    }

//    /**
//     * {@inheritDoc}
//     */
//    public function clean()
//    {
//        $this->data = [];
//        $this->name = null;
//    }
}

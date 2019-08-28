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
            $this->name = $_SERVER['DOCUMENT_ROOT'] . $filename . '.txt';
            $this->data = fopen($this->name, 'w');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        } else {
            $file = file($this->name);

            for ($i = 0; $i < count($file); $i++) {
                $split[$i] = preg_split('/ => /', $file[$i]);
            }

            for ($j = 0; $j < count($split); $j++) {
                if (in_array($index, $split[$j])) {
                    $key = array_search($index, $split[$j]);
                    $defaultValue = $split[$j][$key + 1];
                    $defaultValue = preg_replace('/\s+/', '', $defaultValue);

                    if ($defaultValue == 'true') {
                        $defaultValue = true;
                    } elseif ($defaultValue == 'false') {
                        $defaultValue = false;
                    }

                    return $defaultValue;
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value)
    {
        if (is_array($value)) {
            for ($i = 0; $i < count($value); $i++) {
                if (is_bool($value[$i])) {
                    $value[$i] = $value[$i] ? 'true' : 'false';
                    fwrite($this->data, $index . ' => ' . $value[$i] . PHP_EOL);
                } else {
                    fwrite($this->data, $index . ' => ' . $value[$i] . PHP_EOL);
                }
            }
        } else {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
                fwrite($this->data, $index . ' => '  . $value . PHP_EOL);
            } else {
                fwrite($this->data, $index . ' => ' . $value . PHP_EOL);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        if (!(is_null($this->name))) {
            $file = file($this->name);
            for ($i = 0; $i < count($file); $i++) {
                if (preg_match('/' . $index . '/', $file[$i])) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        if (!(is_null($this->name))) {
            return count(file($this->name));
        }
        return 0;
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = [];
        $this->name = null;
    }
}

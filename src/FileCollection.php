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
        }
//        } else {
////            $file = file($this->name);
////
////            var_dump($file);
////            exit;
//            $split = (preg_split('/ => /', $file[$i]));
//                if (array_key_exists(strval($split[0]), $file_map)) {
//                    $file_map[strval($split[0][0])] = $file_map[strval($split[0])];
//                    $file_map[strval($split[0][1])]= $split[1];
//                    $repeat_counter++;
//                } else {
//                    $file_map[strval($split[0])]= $split[1];
//                }
//                var_dump($split);
//        }

//        var_dump($file_map);
//        exit;
//        var_dump($file[0]);
//        var_dump($index);
//
//        var_dump(preg_match('/'. $index . '/', $file[0]));

        return 'value';
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

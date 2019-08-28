<?php

namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FileCollectionTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new FileCollection();
        return $collection;
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function objectCanBeConstructedWithNullParameter()
    {
        $collection = new FileCollection();
        $this->assertEquals(null, $collection->name);
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function objectCanBeConstructedWithFileName()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $this->assertEquals($_SERVER['DOCUMENT_ROOT'] . $name . '.txt', $collection->name);
        return $collection;
    }

    /**
     * @test
     * @depends objectCanBeConstructedWithFileName
     * @doesNotPerformAssertions
     */
    public function dataCanBeAdded()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $collection->set('index1', 'value');
        $collection->set('index2', 5);
        $collection->set('index3', true);
        $collection->set('index4', 6.5);
        $collection->set('index5', ['data']);
        $collection->set('index6', [true, false, true, true, false, false]);
        $collection->set('index7', [true, 'valuer', 1.25, true, 20, false]);

        return $collection;
    }

//    /**
//     * @test
//     * @depends dataCanBeAdded
//     */
//    public function dataCanBeRetrieved()
//    {
//        $name = 'arquivoX';
//        $collection = new FileCollection($name);
//
//        $this->assertEquals('value', $collection->get('index1'));
//    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $this->assertEquals('defaultValue', $collection->get('index75', 'defaultValue'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function newCollectionShouldNotContainItems()
    {
        $collection = new FileCollection();

        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $collection->set('index1', 'value');
        $collection->set('index2', 5);
        $collection->set('index3', true);

        $this->assertEquals(3, $collection->count());
    }

    /**
     * @test
     * @depends collectionWithItemsShouldReturnValidCount
     */
    public function collectionCanBeCleaned()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $collection->set('index', 'value');
        $this->assertEquals(1, $collection->count());

        $collection->clean();
        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function addedItemShouldExistInCollection()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $collection->set('index', 'value');

        $this->assertTrue($collection->has('index'));
    }
}

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

        $this->assertEquals($name, $collection->name);
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
//        $collection->set('index1', 'value');
//
//        $this->assertEquals('value', $collection->get('index1'));
//    }
//
//    /**
//     * @test
//     * @depends objectCanBeConstructed
//     */
//    public function inexistentIndexShouldReturnDefaultValue()
//    {
//        $collection = new FileCollection();
//
//        $this->assertNull($collection->get('index1'));
//        $this->assertEquals('defaultValue', $collection->get('index1', 'defaultValue'));
//    }
//
//    /**
//     * @test
//     * @depends objectCanBeConstructed
//     */
//    public function newCollectionShouldNotContainItems()
//    {
//        $collection = new FileCollection();
//        $this->assertEquals(0, $collection->count());
//    }
//
//    /**
//     * @test
//     * @depends dataCanBeAdded
//     */
//    public function collectionWithItemsShouldReturnValidCount()
//    {
//        $collection = new FileCollection();
//        $collection->set('index1', 'value');
//        $collection->set('index2', 5);
//        $collection->set('index3', true);
//
//        $this->assertEquals(3, $collection->count());
//    }
//
//    /**
//     * @test
//     * @depends collectionWithItemsShouldReturnValidCount
//     */
//    public function collectionCanBeCleaned()
//    {
//        $collection = new FileCollection();
//        $collection->set('index', 'value');
//        $this->assertEquals(1, $collection->count());
//
//        $collection->clean();
//        $this->assertEquals(0, $collection->count());
//    }
//
//    /**
//     * @test
//     * @depends dataCanBeAdded
//     */
//    public function addedItemShouldExistInCollection()
//    {
//        $collection = new FileCollection();
//        $collection->set('index', 'value');
//
//        $this->assertTrue($collection->has('index'));
//    }
}

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

        $this->assertNull($collection->name);
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

        $collection->set('index6', array(true, false, true, true, false, false));
        $collection->set('index7', array(true, 'valuer', 1.25, true, 20, false));
        $collection->set('index1', 'value');
        $collection->set('index2', 5);
        $collection->set('index3', true);
        $collection->set('index666', false);
        $collection->set('index4', 6.5);
        $collection->set('index5', ['data']);

        return $collection;
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function addedItemShouldExistInCollection()
    {
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $collection->set('index1', 'value');

        $this->assertTrue($collection->has('index1'));
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function dataCanBeRetrieved()
    {
        $collection = self::dataCanBeAdded();

        $collection->set('index245', 'value22');

        $this->assertEquals('5', $collection->get('index2'));
        $this->assertEquals('value22', $collection->get('index245'));
        $this->assertEquals('6.5', $collection->get('index4'));
        $this->assertTrue($collection->get('index3'));
        $this->assertFalse($collection->get('index666'));
    }

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
        $name = 'arquivoX';
        $collection = new FileCollection($name);

        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends newCollectionShouldNotContainItems
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
}

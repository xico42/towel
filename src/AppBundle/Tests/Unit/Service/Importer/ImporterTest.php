<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 14:03
 */

namespace AppBundle\Tests\Unit\Service\Importer;

use AppBundle\Entity\Person;
use AppBundle\Service\Importer\XmlImporter;
use PHPUnit\Framework\TestCase;

class ImporterTest extends TestCase
{
    /**
     * @test
     */
    public function import_ValidPeopleXml_ShouldReturnACollectionOfPerson()
    {
        $importer = new XmlImporter();
        $people = $importer->import(file_get_contents(__DIR__ . '/people.xml'));
        $this->assertContainsOnlyInstancesOf(Person::class, $people);
        return $people;
    }

    /**
     * @test
     * @depends import_ValidPeopleXml_ShouldReturnACollectionOfPerson
     * @param array $people
     */
    public function import_ValidPeopleXmlGiven_ShouldReturnACollectionWithTheSamePersonQuantity(array $people)
    {
        $this->assertCount(3, $people);
    }

    /**
     * @test
     * @depends import_ValidPeopleXml_ShouldReturnACollectionOfPerson
     * @param array $people
     */
    public function import_ValidPeopleXmlGiven_ShouldReturnTheCorrectPeople(array $people)
    {
        $this->assertEquals(1, $people[0]->getId());
        $this->assertEquals('Name 1', $people[0]->getName());

        $this->assertEquals(2, $people[1]->getId());
        $this->assertEquals('Name 2', $people[1]->getName());

        $this->assertEquals(3, $people[2]->getId());
        $this->assertEquals('Name 3', $people[2]->getName());
    }
}
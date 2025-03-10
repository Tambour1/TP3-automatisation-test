<?php

namespace Tests;

use App\Entity\Product;
use App\Entity\Person;
use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{   
    private Person $person;
    private Wallet $wallet;
    private Product $product;

    public function setUp(): void
    {
        $this->person = new Person('John Doe', 'USD');
        $this->wallet = new Wallet('USD');
        $this->product = new Product('banane', ['USD' => 100.0,'EUR' => 99.0], 'food');
    }

    public function testGetName(): void
    {
        $this->assertEquals('John Doe', $this->person->getName());
        $this->assertIsString($this->person->getName());
    }

    public function testSetName(): void
    {
        $this->person->setName('Jane Doe');
        $this->assertEquals('Jane Doe', $this->person->getName());
        $this->assertIsString($this->person->getName());
    }

    public function testGetWallet(): void
    {
        $this->assertEquals($this->wallet, $this->person->getWallet());
        $this->assertInstanceOf(Wallet::class, $this->person->getWallet());
    }

    public function testSetWallet(): void
    {   
        $wallet = new Wallet('EUR');
        $this->person->setWallet($wallet);
        $this->assertEquals($wallet, $this->person->getWallet());
        $this->assertInstanceOf(Wallet::class, $this->person->getWallet());
    }

    public function testHasFund(): void
    {
        $this->wallet->addFund(50.0);
        $this->person->setWallet($this->wallet);
        $this->assertTrue($this->person->hasFund());

        $this->wallet->removeFund(50.0);
        $this->person->setWallet($this->wallet);
        $this->assertFalse($this->person->hasFund());
    }
}

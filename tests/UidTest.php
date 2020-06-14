<?php

use \PHPUnit\Framework\TestCase;
use \PragmaPHP\Uid\Uid;

class UidTest extends TestCase {

    public function testDynamicTime() {
        $former1 = Uid::generate();
        $former2 = Uid::generate();
        for ($i = 1; $i <= 10000; $i++) {
            $actual1 = Uid::generate();
            $actual2 = Uid::generate();
            $this->assertNotEmpty($actual1);
            $this->assertNotEmpty($actual2);
            $this->assertNotEquals($actual1, $actual2);
            $this->assertNotEquals($actual1, $former1);
            $this->assertNotEquals($actual1, $former2);
            $this->assertNotEquals($actual2, $former1);
            $this->assertNotEquals($actual2, $former2);
            $this->assertNotEquals($actual2, $former2);
            $this->assertTrue(strlen($actual1) == 26);
            $this->assertTrue(strlen($actual2) == 26);
            $this->assertTrue(preg_match('([ilouILOU])', $actual1) == 0);
            $this->assertTrue(preg_match('([ilouILOU])', $actual2) == 0);
            $this->assertTrue(preg_match('([0-9])', Uid::decode($actual1)) !== 0);
            $this->assertTrue(preg_match('([0-9])', Uid::decode($actual2)) !== 0);
            $former1 = $actual1;
            $former2 = $actual2;
        }
    }

    public function testInjectedTime() {
        $time = round(microtime(true)*1000);
        $former1 = Uid::generate($time);
        $former2 = Uid::generate($time);
        for ($i = 1; $i <= 10000; $i++) {
            $actual1 = Uid::generate($time);
            $actual2 = Uid::generate($time);
            $this->assertNotEmpty($actual1);
            $this->assertNotEmpty($actual2);
            $this->assertNotEquals($actual1, $actual2);
            $this->assertNotEquals($actual1, $former1);
            $this->assertNotEquals($actual1, $former2);
            $this->assertNotEquals($actual2, $former1);
            $this->assertNotEquals($actual2, $former2);
            $this->assertNotEquals($actual2, $former2);
            $this->assertTrue(strlen($actual1) == 26);
            $this->assertTrue(strlen($actual2) == 26);
            $this->assertTrue(preg_match('([ilouILOU])', $actual1) == 0);
            $this->assertTrue(preg_match('([ilouILOU])', $actual2) == 0);
            $this->assertTrue(preg_match('([0-9])', Uid::decode($actual1)) !== 0);
            $this->assertTrue(preg_match('([0-9])', Uid::decode($actual2)) !== 0);
            $former1 = $actual1;
            $former2 = $actual2;
        }
    }

}
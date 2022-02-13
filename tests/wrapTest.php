<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class wrapTest extends TestCase
{
    public function test1(): void
    {
        $this->assertEquals(Wrap::wrap("word word", 4), "word\nword");
    }

    public function test2(): void
    {
        $this->assertEquals(Wrap::wrap("word word", 1), "w\no\nr\nd\nw\no\nr\nd");
    }

    public function test3(): void
    {
        $this->assertEquals(Wrap::wrap("abcdefghij", 3), "abc\ndef\nghi\nj");
    }

    public function test4(): void
    {
        $this->assertEquals(Wrap::wrap("The    quick    brown     fox   jumps   over   the lazy   dog", 10), "The\nquick\nbrown\nfox\njumps\nover   the\nlazy   dog");
    }

    public function test5(): void
    {
        $this->assertEquals(Wrap::wrap("hello   world   my name is Johnny-English", 3), "hel\nlo\nwor\nld\nmy\nnam\ne\nis\nJoh\nnny\n-En\ngli\nsh");
    }

    public function test6(): void
    {
        $this->assertEquals(Wrap::wrap("test\ntesting", 4), "test\ntest\ning");
    }

    public function test7(): void
    {
        $this->assertEquals(Wrap::wrap("Squidward", 2), "Sq\nui\ndw\nar\nd");
    }

    public function test8(): void
    {
        $this->assertEquals(Wrap::wrap("Lots of small words and a big length to do not much breaking", 12), "Lots of\nsmall words\nand a big\nlength to do\nnot much\nbreaking");
    }

    public function test9(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$length cannot be negative');
        Wrap::wrap("blah", -1);
    }

    public function test10(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$length cannot be zero');
        Wrap::wrap("blah", 0);
    }

    public function test11(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$string cannot be empty');
        Wrap::wrap("", 1);
    }

    public function test12 (): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$string cannot be only whitespaces');
        Wrap::wrap("   ", 2);
    }
}
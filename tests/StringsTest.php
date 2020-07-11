<?php

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{
    /**
     * @see https://www.php.net/manual/en/language.types.string.php
     */
    public function testVariableParsing()
    {
        $foo = 'world';

        // Double quotes.
        $this->assertEquals('Hello world', "Hello $foo");

        // Single quotes.
        $this->assertEquals('Hello $foo', 'Hello $foo');

        // TODO "Hello ${foo}"
        $this->assertEquals('Hello world', "Hello ${foo}");

        // TODO "Hello " . $foo
        $this->assertEquals('Hello world', "Hello " . $foo);

        // TODO Heredoc
        $this->assertEquals('Hello world', <<<EOT
Hello $foo
EOT);

        // TODO Nowdoc
        $this->assertEquals('Hello $foo', <<<'EOT'
Hello $foo
EOT);
    }

    /**
     * @see https://www.php.net/manual/en/ref.strings.php
     */
    public function testStringFunctions()
    {
        // trim — Strip whitespace (or other characters) from the beginning and end of a string
        $this->assertEquals('Hello', trim('Hello         '));
        $this->assertEquals('Hello', trim('Hello......', '.'));

        // ltrim — Strip whitespace (or other characters) from the beginning of a string
        $this->assertEquals('Hello', ltrim('             Hello'));
        $this->assertEquals('Hello', ltrim('//////////Hello', '/'));

        // rtrim — Strip whitespace (or other characters) from the end of a string
        $this->assertEquals('Hello', rtrim('Hello               '));
        $this->assertEquals('Hello', rtrim('Hello7777777777777', '7'));

        // strtoupper — Make a string uppercase
        $this->assertEquals('HELLO', strtoupper('hello'));

        // strtolower — Make a string lowercase
        $this->assertEquals('hello', strtolower('HeLlO'));

        // ucfirst — Make a string's first character uppercase
        $this->assertEquals('HELLO', ucfirst('hELLO'));

        // lcfirst — Make a string's first character lowercase
        $this->assertEquals('hello', lcfirst('Hello'));

        // strip_tags — Strip HTML and PHP tags from a string
        $this->assertEquals('hello', strip_tags("<internal_element>h<?php?>e<br><from>l<src><b>l</src><canvas>o</canvas></from></internal_element></canvas></b></canvas>"));

        // htmlspecialchars — Convert special characters to HTML entities
        $this->assertEquals('&#039;&lt;&amp;&#039;&gt;', htmlspecialchars("'<&'>", ENT_QUOTES, 'UTF-8'));

        // addslashes — Quote string with slashes
        $this->assertEquals("Isn\'t O\'Donovan come at 2 o\'clock?", addslashes("Isn't O'Donovan come at 2 o'clock?"));

        // strcmp — Binary safe string comparison
        $firstStr = 'Hello';
        $secondStr = 'Hello world';
        $this->assertEquals($firstStr < $secondStr, strcmp($firstStr, $secondStr));

        // strncasecmp — Binary safe case-insensitive string comparison of the first n characters
        $this->assertEquals(0, strncasecmp('hello world', 'Hello Williams',7));

        // str_replace — Replace all occurrences of the search string with the replacement string
        $this->assertEquals('Hi everyone now.', str_replace(array('Hello','world'), array('Hi', 'everyone'), "Hello world now."));

        // strpos — Find the position of the first occurrence of a substring in a string
        $this->assertEquals('7',strpos('Hello old world', 'ld'));

        // strstr — Find the position of the first occurrence of a substring in a string
        $this->assertEquals('world', strstr('Hello wacky world', 'wo'));

        // strrchr — Find the last occurrence of a character in a string
        $this->assertEquals('d.', strrchr('That day was a good day for everyone around.', 'd'));

        // substr — Return part of a string
        $this->assertEquals('ello ', substr('Hello world', 1, 5));

        // sprintf — Return a formatted string
        $this->assertEquals("How many times I have typed 'Hello world' here? I guess at least 20 times and that's too much.", sprintf('How many times I have typed %2$s here? I guess at least %1$d times and that\'s too much.', 20, '\'Hello world\''));
    }
}
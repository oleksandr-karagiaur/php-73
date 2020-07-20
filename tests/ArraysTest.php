<?php

use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testIntegerKey()
    {
        $arr = [];
        $arr[] = 'a';
        $arr[] = 'b';
        $arr[] = 'c';

        // Which index will have 'c'?
        $this->assertEquals(2, array_key_last($arr));

        $arr[10] = 'd';
        $arr[] = 'e';

        // Which index will have 'e'?
        $this->assertEquals(11, array_key_last($arr));

        $arr['string'] = 'f';
        $arr[] = 'h';

        // Which index will have 'h'?
        $this->assertEquals(12, array_key_last($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testKeyCasting()
    {
        $arr = [];
        $arr[] = 'a';
        $arr["1"] = 'b';
        $arr["01"] = 'c';
        $arr[true] = 'd';
        $arr[0.5] = 'e';
        $arr[false] = 'f';
        $arr[null] = 'g';

        // Which keys will have $arr
        $this->assertEquals([0, 1, '01', ''], array_keys($arr));

        // Which values will have $arr
        $this->assertEquals(['f', 'd', 'c', 'g'] , array_values($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/language.operators.array.php
     * @see https://www.php.net/manual/en/function.array-merge.php
     * @see https://www.php.net/manual/en/function.array-replace.php
     */
    public function testArraysOperations()
    {
        // Union
        $arr1 = ['a', 'b'];
        $arr2 = ['c', 'd', 'e', 'key' => 'value'];
        $this->assertEquals(['a', 'b', 'e', 'key' => 'value'], $arr1 + $arr2);

        // array_merge — Merge one or more arrays
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals(['a', 'b', 'key1' => 'value3', 'key2' => 'value2', 1, 'key3' => 'value4'], array_merge($arr1, $arr2));

        // array_replace — Replaces elements from passed arrays into the first array
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals([1, 'b', 'key1' => 'value3', 'key2' => 'value2', 'key3' => 'value4'], array_replace($arr1, $arr2));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/book.array.php
     */
    public function testArrayFunctions()
    {
        // list - Assign variables as if they were an array
        list(, , list($var)) = ['a', 'b', ['c', 'd']];
        $this->assertEquals('c', $var);

        // implode — Join array elements with a string
        $var = implode([1, 2, 3, 4]);
        $this->assertEquals('1234', $var);

        // sizeof — Alias of count
        $arr = sizeof([false, '5', 7, 'key' => 'value', 'key2' => 5, true, '', null, 'hey there', '' => null, 0.34]);
        $this->assertEquals(11, $arr);
        $this->assertEquals(11, $arr);

        // unset — Unset a given variable
        $arr = [1, 2, 3, 4];
        unset($arr[0]);
        $this->assertEquals([1, 2, 3], array_keys($arr));

        // isset — Determine if a variable is declared and is different than NULL
        $arr = [1, 2, 'key' => 'value', null, false, true];
        $this->assertEquals(true, isset($arr[0]));
        $this->assertEquals(true, isset($arr['key']));
        $this->assertEquals(false, isset($arr[2]));
        $this->assertEquals(true, isset($arr[3]));
        $this->assertEquals(true, isset($arr[4]));
        $this->assertEquals(false, isset($arr[5]));
        $this->assertEquals(false, isset($arr[6]));


        // array_key_exists — Checks if the given key or index exists in the array
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(true, array_key_exists(0, $arr));
        $this->assertEquals(true, array_key_exists('key', $arr));
        $this->assertEquals(true, array_key_exists(2, $arr));
        $this->assertEquals(false, array_key_exists(3, $arr));
        $this->assertEquals(false, array_key_exists(4, $arr));


        // in_array — Checks if a value exists in an array
        $this->assertEquals(true, in_array('value', $arr));
        $this->assertEquals(true, in_array(1, $arr));
        $this->assertEquals(true, in_array(null, $arr));
        $this->assertEquals(true, in_array('1', $arr));
        $this->assertEquals(false, in_array('key', $arr));
        $this->assertEquals(true, in_array('', $arr));
        $this->assertEquals(false, in_array(0.35, $arr));

        // array_flip — Exchanges all keys with their associated values in an array
        $arr = ['n' => '5', 7, 'key' => 'value', 'key2' => 5, 'hey there', 0];
        $this->assertEquals(['5' => 'n', 7 => 0, 'value' => 'key', 5 => 'key2', 'hey there' => 1, 0 => 2], array_flip($arr));

        // array_reverse — Return an array with elements in reverse order
        $this->assertEquals([0 => 0, 1 => 'hey there', 'key2' => 5, 'key' => 'value', 2 => 7, 'n' => '5'], array_reverse($arr));
        $this->assertEquals([2 => 0, 1 => 'hey there', 'key2' => 5, 'key' => 'value', 0 => 7, 'n' => '5'], array_reverse($arr, true));

        // array_keys — Return all the keys or a subset of the keys of an array
        $this->assertEquals(['n', 0, 'key', 'key2', 1, 2], array_keys($arr));
        $this->assertEquals(['n', 'key2'], array_keys($arr, '5'));

        // array_values — Return all the values of an array
        $this->assertEquals(['5', 7, 'value', 5, 'hey there', 0], array_values($arr));


        // array_filter — Filters elements of an array using a callback function
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $this->assertEquals([0 => 1, 2 => 3, 4 => 5, 6 => 7, 8 => 9], array_filter($arr, function ($value) {
            return $value % 2 > 0;
        }));

        // array_map — Applies the callback to the elements of the given arrays
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $this->assertEquals([2, 4, 6, 8, 10, 12, 14, 16, 18, 20], array_map(function ($value) {
            return $value * 2;
        }, $arr));

        // sort — Sort an array
        $arr = ['n' => '5', 7, 'key' => 'value', 'key2' => 5, 'hey there', 0];
        function arrsort($arr)
        {
            sort($arr, SORT_NUMERIC);
            return $arr;
        }

        $this->assertEquals(['value', 'hey there', 0, '5', 5, 7], arrsort($arr));

        // rsort — Sort an array in reverse order
        function rarrsort($arr)
        {
            rsort($arr, SORT_NUMERIC);
            return $arr;
        }

        $this->assertEquals([7, '5', 5, 'value', 'hey there', 0], rarrsort($arr));

        // ksort — Sort an array by key
        $arrk = ['n' => '5', 'b' => 7, 'key' => 'value', 'key2' => 5, 'hey there', 0];
        function karrsort($arrk)
        {
            ksort($arrk);
            return $arrk;
        }

        $this->assertEquals(['b' => 7, 'key' => 'value', 'key2' => 5, 'n' => '5', 0 => 'hey there', 1 => 0], karrsort($arrk));

        // usort — Sort an array by values using a user-defined comparison function
        $arr = [5, 7, 35, 377, -13, 345, 0, 456, 11, 6, 70, 43, 23, 8];
        $b = 0;
        function nc($arr, $b)
        {
            if ($arr === $b) {
                return 0;
            }
                return ($arr < $b) ? 1 : -1;
        }
        function usr($arr, $b)
        {
            usort($arr, "nc");
            return $arr;
        }
        $this->assertEquals([456, 377, 345, 70, 43, 35, 23, 11, 8, 7, 6, 5, 0, -13], usr($arr, $b));



        // array_push — Push one or more elements onto the end of array
        array_push($arr, -15);
        $this->assertEquals(-15, end($arr));
        // array_pop — Pop the element off the end of array
        array_pop($arr);
        $this->assertEquals(8, end($arr));

        // array_shift — Shift an element off the beginning of array
        array_shift($arr);
        $this->assertEquals(7, $arr[0]);
        // array_unshift — Prepend one or more elements to the beginning of an array
        array_unshift($arr, -154, 43);
        $this->assertEquals(-154, $arr[0]);
        $this->assertEquals(43, $arr[1]);
    }
}
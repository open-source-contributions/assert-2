<?php
declare(strict_types=1);
/**
 * This file is part of bovigo\assert.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace bovigo\assert\predicate;
use bovigo\assert\AssertionFailure;
use PHPUnit\Framework\TestCase;

use function bovigo\assert\{
    assertFalse,
    assertNotNull,
    assertNull,
    assertTrue,
    expect
};
/**
 * Tests for bovigo\assert\predicate\IsNull.
 *
 * @group  predicate
 */
class IsNullTest extends TestCase
{
    /**
     * @test
     */
    public function evaluatesToTrueIfGivenValueIsNull(): void
    {
        assertTrue(isNull()->test(null));
    }

    /**
     * @return  array<string,array<mixed>>
     */
    public function nonNullValues(): array
    {
        return [
          'boolean true'     => [true],
          'boolean false'    => [false],
          'non-empty string' => ['foo'],
          'empty string'     => [''],
          'empty array'      => [[]],
          'non-empty array'  => [[1]],
          'int 0'            => [0],
          'int non-0'        => [303]
        ];
    }

    /**
     * @param  mixed  $nonNullValue
     * @test
     * @dataProvider  nonNullValues
     */
    public function evaluatesToFalseIfGivenValueIsNotNull($nonNullValue): void
    {
        assertFalse(isNull()->test($nonNullValue));
    }

    /**
     * @test
     */
    public function assertionFailureContainsMeaningfulInformation(): void
    {
        expect(function() { assertNull([]); })
                ->throws(AssertionFailure::class)
                ->withMessage("Failed asserting that an array is null.");
    }

    /**
     * @test
     * @since  1.3.0
     */
    public function aliasAssertNotNull(): void
    {
        assertTrue(assertNotNull(303));
    }
}

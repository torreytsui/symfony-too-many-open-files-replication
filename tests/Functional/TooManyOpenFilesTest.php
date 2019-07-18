<?php

namespace App\Tests\Functional;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TooManyOpenFilesTest extends KernelTestCase
{
    /**
     * @dataProvider provideTooManyOpenFiles
     */
    public function testTooManyOpenFiles(string $message)
    {
        static::bootKernel();

        static::$container->get('logger')->notice($message);

        static::assertTrue(true);
    }

    public function provideTooManyOpenFiles()
    {
        // Increase $i until the issue is triggered
        $testCases = [];
        for ($i = 1; $i <= 10000; $i++) {
            $testCases['Test Case '.$i] = [
                'Hello world '.$i,
            ];
        }

        return $testCases;
    }
}

<?php
namespace Hostnet\Component\AccessorGenerator\Generator;

use Hostnet\Component\AccessorGenerator\Generator\fixtures\CredentialsAgain;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Generated\KeyRegistry;
use PHPUnit\Framework\TestCase;

class CredentialsAgainTest extends TestCase
{
    /**
     * @var CredentialsAgain
     */
    private $credentials_again;

    protected function setUp()
    {
        KeyRegistry::addPublicKeyPath(
            'database.table.column_again',
            'file:///' . __DIR__ . '/Key/credentials_public_key.pem'
        );

        $this->credentials_again = new CredentialsAgain();
    }

    public function testSetPassword()
    {
        $this->credentials_again->setPassword('password');

        $reflection_class    = new \ReflectionClass($this->credentials_again);
        $reflection_property = $reflection_class->getProperty('password');
        $reflection_property->setAccessible(true);

        self::assertNotEmpty($reflection_property->getValue($this->credentials_again));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetPasswordTooManyArguments()
    {
        $credentials_again = new CredentialsAgain();
        $credentials_again->setPassword(1, 2);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetPasswordArray()
    {
        $credentials = new CredentialsAgain();
        $credentials->setPassword([]);
    }
}

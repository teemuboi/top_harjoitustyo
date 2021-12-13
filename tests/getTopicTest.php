<?php declare(strict_types=1);
require_once "database/connection.php";
require_once "database/models/messages.php";
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    private $conn = null;
 
    final public function getConnection() {
        if ($this->conn === null) {
            $conn = connectDB();
        }
 
        return $this->conn;
    }

    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $result = addMessage("a", 1);
        $this->assertEquals(
            1,
            $result
        );
    }

    // public function testCannotBeCreatedFromInvalidEmailAddress(): void
    // {
    //     $this->expectException(InvalidArgumentException::class);

    //     Email::fromString('invalid');
    // }

    // public function testCanBeUsedAsString(): void
    // {
    //     $this->assertEquals(
    //         'user@example.com',
    //         Email::fromString('user@example.com')
    //     );
    // }
}
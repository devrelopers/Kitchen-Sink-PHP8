<?php
declare(strict_types=1);

/**
 * PHP 8.0, 8.1, 8.2, and 8.3 Kitchen Sink
 * This file demonstrates all major features introduced in PHP 8.x
 */

// ============================================
// PHP 8.0 FEATURES
// ============================================

// 1. Named Arguments
function greet(string $name, string $greeting = "Hello", bool $exclaim = false): string {
    $message = "$greeting, $name";
    return $exclaim ? "$message!" : "$message.";
}

// Usage with named arguments
echo greet(name: "World", exclaim: true, greeting: "Hi") . PHP_EOL;

// 2. Union Types
class Number {
    private int|float $value;
    
    public function __construct(int|float $value) {
        $this->value = $value;
    }
    
    public function getValue(): int|float {
        return $this->value;
    }
}

// 3. Match Expression
function getDayType(int $day): string {
    return match($day) {
        1, 7 => 'Weekend',
        2, 3, 4, 5, 6 => 'Weekday',
        default => 'Invalid day'
    };
}

// 4. Nullsafe Operator
class Address {
    public function __construct(
        public ?string $street = null,
        public ?string $city = null
    ) {}
}

class User {
    public function __construct(
        public string $name,
        public ?Address $address = null
    ) {}
}

$user = new User('John', new Address('Main St', 'NYC'));
echo $user->address?->city ?? 'No city' . PHP_EOL;

// 5. Constructor Property Promotion
class Product {
    public function __construct(
        public readonly string $name,
        public readonly float $price,
        private int $stock = 0
    ) {}
}

// 6. Attributes (Annotations)
#[Attribute]
class Route {
    public function __construct(
        public string $path,
        public string $method = 'GET'
    ) {}
}

#[Route('/api/users', 'GET')]
class UserController {
    #[Route('/api/users/{id}', 'GET')]
    public function getUser(int $id): array {
        return ['id' => $id, 'name' => 'User ' . $id];
    }
}

// 7. String functions: str_contains, str_starts_with, str_ends_with
$haystack = 'The quick brown fox';
var_dump(str_contains($haystack, 'quick'));     // true
var_dump(str_starts_with($haystack, 'The'));    // true
var_dump(str_ends_with($haystack, 'fox'));      // true

// 8. Weak Maps
$weakMap = new WeakMap();
$obj = new stdClass();
$weakMap[$obj] = 'Some value';

// 9. Mixed Type
function processValue(mixed $value): mixed {
    return is_string($value) ? strtoupper($value) : $value;
}

// 10. Throw Expression
$value = $_GET['value'] ?? throw new InvalidArgumentException('Value required');

// 11. Non-capturing catches
try {
    // Some code that might throw
    throw new Exception('Test exception');
} catch (Exception) {
    // Handle exception without capturing it in a variable
    echo "An exception occurred\n";
}

// ============================================
// PHP 8.1 FEATURES
// ============================================

// 1. Enumerations
enum Status: string {
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    
    public function getLabel(): string {
        return match($this) {
            self::PENDING => 'Waiting for approval',
            self::APPROVED => 'Has been approved',
            self::REJECTED => 'Has been rejected',
        };
    }
}

$status = Status::PENDING;
echo $status->value . ': ' . $status->getLabel() . PHP_EOL;

// 2. Readonly Properties (already shown in constructor promotion)
class ImmutableData {
    public readonly string $id;
    
    public function __construct(string $id) {
        $this->id = $id;
    }
}

// 3. First-class Callable Syntax
function multiply(int $a, int $b): int {
    return $a * $b;
}

$multiplyBy2 = multiply(...);
echo $multiplyBy2(5, 2) . PHP_EOL; // 10

// 4. New in Initializers
class Service {
    public function __construct(
        private Logger $logger = new Logger()
    ) {}
}

class Logger {
    public function log(string $message): void {
        echo "[LOG] $message\n";
    }
}

// 5. Pure Intersection Types
interface Cacheable {
    public function getCacheKey(): string;
}

interface Serializable {
    public function serialize(): string;
}

class CacheableService {
    public function cache(Cacheable&Serializable $object): void {
        $key = $object->getCacheKey();
        $data = $object->serialize();
        // Cache logic here
    }
}

// 6. Never Return Type
function alwaysFails(): never {
    throw new RuntimeException('This function never returns');
}

// 7. Array Unpacking with String Keys
$array1 = ['a' => 1, 'b' => 2];
$array2 = ['c' => 3, ...$array1, 'd' => 4];
print_r($array2); // ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4]

// 8. Fibers (Cooperative Multitasking)
$fiber = new Fiber(function (): void {
    echo "Fiber started\n";
    Fiber::suspend('suspended');
    echo "Fiber resumed\n";
});

$value = $fiber->start();
echo "Fiber $value\n";
$fiber->resume();

// 9. Array_is_list Function
var_dump(array_is_list([1, 2, 3]));        // true
var_dump(array_is_list([0 => 'a', 2 => 'b'])); // false

// ============================================
// PHP 8.2 FEATURES
// ============================================

// 1. Readonly Classes
readonly class Configuration {
    public function __construct(
        public string $appName,
        public string $version,
        public array $settings
    ) {}
}

// 2. Disjunctive Normal Form Types (DNF Types)
class ResponseHandler {
    public function handle((Request&Cacheable)|Response $input): void {
        // Handle either a Request that is also Cacheable, or a Response
    }
}

class Request {}
class Response {}

// 3. Allow null, false, and true as Standalone Types
class Result {
    private string|false|null $data;
    
    public function __construct(string|false|null $data = null) {
        $this->data = $data;
    }
    
    public function isSuccess(): true|false {
        return $this->data !== false && $this->data !== null;
    }
}

// 4. Constants in Traits
trait HasVersion {
    public const VERSION = '1.0.0';
    
    public function getVersion(): string {
        return self::VERSION;
    }
}

class VersionedClass {
    use HasVersion;
}

// 5. Dynamic Properties Deprecated (use #[AllowDynamicProperties])
#[AllowDynamicProperties]
class DynamicClass {
    public function __construct() {
        $this->dynamicProperty = 'allowed';
    }
}

// 6. New Random Extension
$randomizer = new Random\Randomizer();
echo $randomizer->getInt(1, 100) . PHP_EOL;
echo $randomizer->shuffleString('abcdef') . PHP_EOL;

// 7. Redacted Parameters in Backtraces
#[SensitiveParameter]
function processPassword(#[SensitiveParameter] string $password): void {
    // Password will be redacted in stack traces
    throw new Exception('Error processing');
}

// 8. Fetch Properties of Enums
enum Color: string {
    case RED = '#FF0000';
    case GREEN = '#00FF00';
    case BLUE = '#0000FF';
}

$colors = Color::cases();
foreach ($colors as $color) {
    echo $color->name . ': ' . $color->value . PHP_EOL;
}

// ============================================
// PHP 8.3 FEATURES
// ============================================

// 1. Typed Class Constants
class MathConstants {
    public const float PI = 3.14159;
    public const int MAX_ITERATIONS = 1000;
    protected const string VERSION = '1.0';
}

// 2. Dynamic Class Constant Fetch
class Config {
    public const DB_HOST = 'localhost';
    public const DB_PORT = 3306;
}

$constantName = 'DB_HOST';
echo Config::{$constantName} . PHP_EOL;

// 3. #[Override] Attribute
class ParentClass {
    public function doSomething(): void {
        echo "Parent implementation\n";
    }
}

class ChildClass extends ParentClass {
    #[Override]
    public function doSomething(): void {
        echo "Child implementation\n";
    }
}

// 4. Deep Cloning of Readonly Properties
readonly class Point {
    public function __construct(
        public float $x,
        public float $y
    ) {}
    
    public function __clone(): void {
        // In PHP 8.3, readonly properties can be modified during cloning
    }
}

// 5. New json_validate() Function
$json = '{"name": "John", "age": 30}';
if (json_validate($json)) {
    echo "Valid JSON\n";
}

// 6. Randomizer::getBytesFromString()
$randomizer = new Random\Randomizer();
$charset = 'abcdefghijklmnopqrstuvwxyz';
$randomString = $randomizer->getBytesFromString($charset, 10);
echo "Random string: $randomString\n";

// 7. Randomizer::getFloat() and nextFloat()
$float = $randomizer->getFloat(0.0, 1.0);
echo "Random float: $float\n";

// 8. Command Line Linter Supports Multiple Files
// Usage: php -l file1.php file2.php file3.php

// ============================================
// ADDITIONAL PHP 8 FEATURES
// ============================================

// Static Return Type
class Factory {
    public static function create(): static {
        return new static();
    }
}

// Stringable Interface
class Message implements Stringable {
    public function __construct(
        private string $content
    ) {}
    
    public function __toString(): string {
        return $this->content;
    }
}

// Get Debug Type
$vars = [
    42,
    'string',
    [],
    new stdClass(),
    null,
    true
];

foreach ($vars as $var) {
    echo get_debug_type($var) . PHP_EOL;
}

// Resource to Object Migration
// Many resources have been migrated to objects in PHP 8
$curl = curl_init();
echo get_debug_type($curl) . PHP_EOL; // CurlHandle

// Consistent Type Errors
// PHP 8 provides more consistent type error messages

// WeakReference
$obj = new stdClass();
$weakRef = WeakReference::create($obj);
var_dump($weakRef->get() !== null); // true
unset($obj);
var_dump($weakRef->get() !== null); // false

// ============================================
// DEPRECATIONS AND REMOVALS
// ============================================

// The following are deprecated or removed in PHP 8:
// - $php_errormsg (use error_get_last())
// - create_function() (use anonymous functions)
// - each() (use foreach)
// - Passing null to non-nullable internal function parameters

// ============================================
// PERFORMANCE IMPROVEMENTS
// ============================================

// JIT Compilation
// PHP 8 includes JIT compilation for improved performance
// Enable with: opcache.enable=1 and opcache.jit=1255

// ============================================
// ERROR HANDLING IMPROVEMENTS
// ============================================

// ValueError for invalid arguments
try {
    json_decode('', false, -1); // Invalid depth
} catch (ValueError $e) {
    echo "ValueError: " . $e->getMessage() . PHP_EOL;
}

// UnhandledMatchError
try {
    $result = match(99) {
        1 => 'one',
        2 => 'two'
        // No default case
    };
} catch (UnhandledMatchError $e) {
    echo "UnhandledMatchError: " . $e->getMessage() . PHP_EOL;
}

// ============================================
// USAGE EXAMPLE
// ============================================

echo "\n=== Kitchen Sink Demo ===\n";

// Create a product using constructor property promotion
$product = new Product('Laptop', 999.99);
echo "Product: {$product->name} - \${$product->price}\n";

// Use enum
$orderStatus = Status::APPROVED;
echo "Order status: {$orderStatus->getLabel()}\n";

// Use match expression
echo "Day 3 is a: " . getDayType(3) . "\n";

// Use named arguments
echo greet(name: "PHP 8", greeting: "Welcome to", exclaim: true) . "\n";

// Demonstrate union types
$number = new Number(42.5);
echo "Number value: " . $number->getValue() . "\n";

echo "\n=== End of Demo ===\n";
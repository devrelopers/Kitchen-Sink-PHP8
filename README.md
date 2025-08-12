# PHP 8 Kitchen Sink

A comprehensive demonstration of all major features introduced in PHP 8.0, 8.1, 8.2, and 8.3.

## Overview

This repository contains `KitchenSink.php`, a single file that demonstrates every significant feature introduced in the PHP 8.x series. It serves as both a learning resource and a quick reference for PHP 8 features.

## Requirements

- PHP 8.3 or higher (to run all features)
- Composer (optional, for dependency management)

## Usage

Run the demonstration:

```bash
php KitchenSink.php
```

## Features Demonstrated

### PHP 8.0 Features

1. **Named Arguments** - Call functions with named parameters
2. **Union Types** - Declare multiple possible types for properties and parameters
3. **Match Expression** - More powerful alternative to switch statements
4. **Nullsafe Operator (`?->`)** - Safely access properties and methods on potentially null objects
5. **Constructor Property Promotion** - Simplified property declaration in constructors
6. **Attributes** - Native annotations for classes and methods
7. **New String Functions** - `str_contains()`, `str_starts_with()`, `str_ends_with()`
8. **Weak Maps** - Store objects as keys without preventing garbage collection
9. **Mixed Type** - Explicit mixed type declaration
10. **Throw Expression** - Use throw in expressions
11. **Non-capturing Catches** - Catch exceptions without storing them

### PHP 8.1 Features

1. **Enumerations** - First-class support for enums
2. **Readonly Properties** - Properties that can only be initialized once
3. **First-class Callable Syntax** - Create callables from functions using `...`
4. **New in Initializers** - Use new expressions in parameter defaults
5. **Pure Intersection Types** - Require multiple interface implementations
6. **Never Return Type** - Indicate functions that never return
7. **Array Unpacking with String Keys** - Spread operator for associative arrays
8. **Fibers** - Lightweight cooperative multitasking
9. **array_is_list()** - Check if an array is a list

### PHP 8.2 Features

1. **Readonly Classes** - Make all properties readonly by default
2. **Disjunctive Normal Form Types** - Complex type combinations with AND and OR
3. **null, false, and true as Standalone Types** - Use these as distinct types
4. **Constants in Traits** - Define constants within traits
5. **Dynamic Properties Deprecated** - Requires `#[AllowDynamicProperties]` attribute
6. **New Random Extension** - Object-oriented random number generation
7. **Sensitive Parameters** - Redact sensitive data in stack traces
8. **Fetch Enum Properties** - Access enum cases and values

### PHP 8.3 Features

1. **Typed Class Constants** - Add types to class constants
2. **Dynamic Class Constant Fetch** - Access constants using variables
3. **#[Override] Attribute** - Explicitly mark method overrides
4. **Deep Cloning of Readonly Properties** - Modify readonly properties during cloning
5. **json_validate()** - Validate JSON without decoding
6. **Randomizer::getBytesFromString()** - Generate random strings from character sets
7. **Randomizer::getFloat()** - Generate random floating-point numbers
8. **Multi-file Linting** - Lint multiple PHP files at once

### Additional Features

- **Static Return Type** - Return type refers to the actual class
- **Stringable Interface** - Interface for objects convertible to strings
- **get_debug_type()** - Enhanced type information for debugging
- **Resource to Object Migration** - Resources converted to objects
- **WeakReference** - Create weak references to objects
- **JIT Compilation** - Just-In-Time compilation for performance
- **Improved Error Handling** - ValueError and UnhandledMatchError exceptions

## Code Structure

The `KitchenSink.php` file is organized into sections:

1. PHP 8.0 Features
2. PHP 8.1 Features
3. PHP 8.2 Features
4. PHP 8.3 Features
5. Additional PHP 8 Features
6. Deprecations and Removals
7. Performance Improvements
8. Error Handling Improvements
9. Usage Examples

Each feature includes:
- Clear comments explaining the feature
- Working code examples
- Practical usage demonstrations

## Learning Path

1. **Start with PHP 8.0** - Understand the foundational changes
2. **Progress through versions** - Each version builds on the previous
3. **Run the examples** - Execute the code to see features in action
4. **Modify and experiment** - Change the code to deepen understanding

## Best Practices

- Use **named arguments** for better readability
- Prefer **match expressions** over complex switch statements
- Leverage **enums** for type-safe constants
- Use **readonly properties** for immutable data
- Apply **attributes** for metadata and configuration
- Utilize **union types** for flexible type declarations

## Notes

- Some features require specific PHP versions to run
- JIT compilation requires OPcache configuration
- Error examples are caught to prevent script termination
- All examples are self-contained and runnable

## Contributing

Feel free to suggest additional examples or improvements to existing demonstrations.

## License

This educational resource is provided as-is for learning purposes.

## References

- [PHP 8.0 Release Notes](https://www.php.net/releases/8.0/en.php)
- [PHP 8.1 Release Notes](https://www.php.net/releases/8.1/en.php)
- [PHP 8.2 Release Notes](https://www.php.net/releases/8.2/en.php)
- [PHP 8.3 Release Notes](https://www.php.net/releases/8.3/en.php)
- [PHP Manual](https://www.php.net/manual/)
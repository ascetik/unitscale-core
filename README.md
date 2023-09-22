# unitscale-core
A scale converter for any unit

This tool is able to convert a unit measurement multiple to another.
You can convert an amount of _bytes_ to _megabytes_, *millimeters* to *kilometers* on so on or any unit from any multiple to any other.

## Release notes :

> version 0.2.0

- behaviour abstraction : to re-use for extensions
- main implementation : specify the unit to use, the scale to start from and the scale to get finally.

## Converter Instances

A **UnitScaler** factory provides converters statically.

### Custom conversion

The main converter is provided by _convert()_ method :

```php

$converter = CustomScaler::convert(3000, 'b');

```

The first argument is the dimension value, the second one is the unit. Here, we want to convert 3000 bytes.

This call returns an instance encapsulating value input, unit input and default base scale.
To get those outputs :

```php

echo $converter->litteral(); // prints '3000b'
echo $converter->raw(); // prints '3000'
echo $converter->getUnit(); // prints 'b'

```

To change multiple to use as source :

```php

$kilo = $converter->fromKilo(); // $kilo is a new converter with its own values
echo $kilo->litteral(); // prints '3000kb'
echo $kilo->raw(); // prints '3000'
echo $kilo->getUnit(); // prints 'kb'

$mega = $converter->fromMega();
echo $mega->litteral(); // prints '3000Mb'
echo $mega->raw(); // prints '3000', either string or float, useful for strict comparison
echo $mega->getUnit(); // prints 'Mb'

echo $converter->litteral(); // still prints '3000b'

```

Converter calls are fluable.
To get your conversion at once, just use :

```php

echo $converter
    ->fromKilo()
    ->toMega()
    ->litteral(); // prints '3Mb'

```

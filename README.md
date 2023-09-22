# unitscale-core

A scale converter for any unit

This tool is able to convert a unit measurement multiple to another.
You can convert an amount of _bytes_ to _megabytes_, _millimeters_ to _kilometers_ on so on or any unit from any multiple to any other.

## Release notes :

> version 0.2.0

- behaviour abstraction : to re-use for extensions
- main implementation : specify the unit to use, the scale to start from and the scale to get finally.

### Custom conversion

Use **Scaler** factory to build a unit object. It just needs a value and the unit to use.
Returned instance has default scale (no unit prefix).

```php

$unit = Scaler::unit(3000, 'b');

```

The first argument is the dimension amount, the second one is the unit to use. Here, we want to convert 3000 bytes.

This call returns an instance with the amount, given unit and default base scale (no unit prefix).

To get those outputs :

```php

echo $unit; // Stringable, prints '3000b'
echo $converter->raw(); // prints 3000
echo $converter->getUnit(); // prints 'b'

```

To change source scale :

```php

$kilo = $unit->fromKilo(); // $kilo is a new unit with its own values
echo $kilo; // prints '3000kb'
echo $kilo->raw(); // prints '3000'
echo $kilo->getUnit(); // prints 'kb'

$mega = $unit->fromMega();
echo $mega; // prints '3000Mb'
echo $mega->raw(); // prints '3000', either string or float, useful for strict comparison
echo $mega->getUnit(); // prints 'Mb'

echo $unit; // still prints '3000b'

```

Fluable methods allow chained calls. To get your conversion at once :

```php

echo $converter->fromKilo()->toMega(); // prints '3Mb'

```


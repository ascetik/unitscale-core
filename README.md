# unitscale-core

A scale converter for any unit

This tool is able to convert a unit measurement multiple to another.
You can convert an amount of _bytes_ to _megabytes_, _millimeters_ to _kilometers_ on so on or any unit from any multiple to any other.

## Release notes :

> version 1.1.0

- Some minor changes for future extensions

## Breaking changes

Use **CustomScaler** factory instaed of **Scaler**

### Usage

Use **CustomScaler** factory to build a unit object. It just needs a value and the unit to use.
Returned instance has default scale (no unit prefix).

```php

$unit = CustomScaler::unit(3000, 'b'); // $unit is a CustomScaleValue with default Scale

```

The first argument is the dimension amount, the second one is the unit to use. Here, we want to work with 3000 bytes.

This call returns an instance with the amount, given unit and default base scale (no unit prefix).

To select another source scale :

```php

$kilo = CustomScaler::fromKilo(3000, 'b'); // to get '3000kb'

$milli = CustomScaler::fromMilli(20,'m'); // to get '20mm'

$firstDumbCall = CustomScaler::fromAnyDumbyScale(1, 'm'); // throws an "unknown command" exception message

$secondDumbCall = CustomScaler::useAnyOtherPrefix(1, 'm'); // throws an Exception too

```

All of those methods return instances of **CustomScaleValue** with adapted scale.

To get the outputs from the first example :

```php

echo $unit; // Stringable, prints '3000b'
echo $converter->raw(); // prints 3000
echo $converter->getUnit(); // prints 'b'

```

You can convert a value to another scale :

```php

echo $unit->toKilo(); // prints '3kb'
echo $unit->fromKilo(); // throws an exception
echo $unit; // still prints '3000b'

echo CustomScaler::fromKilo(3000, 'b')->toMega(); // prints '3Mb'

```

## Scale adjustment

You get sometimes a big amount of any unit from any computation and need to reduce this amount in the adapted scale.

It is possible by using _adjust()_ factory method to get the highest scale the amount can get :

```php

echo CustomScaler::unit(3000, 'm')->adjust(); // prints '3km'

```

You can also limit this adjustment to a different scale :

```php
echo CustomScaler::unit(3000, 'm')->adjust()->asHecto(); // prints '30hm'

echo CustomScaler::unit(3000, 'm')->adjust()->asCenti(); // prints '300000cm'

echo CustomScaler::fromMilli(30000, 'm')
    ->adjust()
    ->asKilo(); // prints '30m', the amount is not enough to get to kilo

```

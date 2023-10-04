# unitscale-core

A scale converter for any unit

This tool is able to convert a unit measurement multiple to another.
You can convert an amount of _bytes_ to _megabytes_, _millimeters_ to _kilometers_ on so on or any unit from any multiple to any other.

## Release notes :

> version 1.0.0

- Base scale selection : use the ScaleValueFactory to get a **ScaleValue** with the correct base scale.
- Ability to handle magical methods with different prefixes according to a context of use. Older version was limited to *to* and *from*.

## Breaking changes

- Methods prefixed by "from" are now implemented statically by a **ScaleValueFactory**.
- A **ScaleValue** only handles methods starting with "to". It is no longer authorized to change its own base scale.
- An **AdjustedScaleValue** uses methods prefixed by *as* instead of *to*: *asMilli()*, * *asKilo()*, ...

### Custom conversion

Use **Scaler** factory to build a unit object. It just needs a value and the unit to use.
Returned instance has default scale (no unit prefix).

```php

$unit = Scaler::unit(3000, 'b'); // $unit is a CustomScaleValue with default Scale

```

The first argument is the dimension amount, the second one is the unit to use. Here, we want to work with 3000 bytes.

This call returns an instance with the amount, given unit and default base scale (no unit prefix).

To select another source scale :

```php

$kilo = Scaler::fromKilo(3000, 'b'); // to get '3000kb'

$milli = Scaler::fromMilli(20,'m'); // to get '20mm'

$firstDumbCall = Scaler::fromAnyDumbyScale(1, 'm'); // throws an "unknown command" exception message

$secondDumbCall = Scaler::useAnyOtherPrefix(1, 'm'); // throws an Exception too

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

echo Scaler::fromKilo(3000, 'b')->toMega(); // prints '3Mb'

```

## Scale adjustment

You get sometimes a big amount of any unit from any computation and need to reduce this amount in the adapted scale.

It is possible by using _adjust()_ factory method to get the highest scale the amount can get :

```php

echo Scaler::unit(3000, 'm')->adjust(); // prints '3km'

```

You can also limit this adjustment to a different scale :

```php
echo Scaler::unit(3000, 'm')->adjust()->asHecto(); // prints '30hm'

echo Scaler::unit(3000, 'm')->adjust()->asCenti(); // prints '300000cm'

echo Scaler::fromMilli(30000, 'm')
    ->adjust()
    ->asKilo(); // prints '30m', the amount is not enough to get to kilo

```

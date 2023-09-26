# unitscale-core

A scale converter for any unit

This tool is able to convert a unit measurement multiple to another.
You can convert an amount of _bytes_ to _megabytes_, _millimeters_ to _kilometers_ on so on or any unit from any multiple to any other.

## Release notes :

> version 0.3.1

- Scale adjustment : a little way opened for missing extension

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

echo $unit->fromKilo(); // prints '3000kb'

```
And to get final unit :

```php

echo $unit->toKilo(); // prints '3kb'

echo $unit; // still prints '3000b'

```

Fluable methods allow chained calls. To get your conversion at once :

```php

echo $unit->fromKilo()->toMega(); // prints '3Mb'

```

## Scale adjustment

You get sometimes a big amount of any unit from any computation and need to reduce this amount in the adapted scale.

It is possible by using *adjust()* factory method to get the highest scale the amount can get :

```php
$adjusted  = Scaler::adjust(3000, 'm');
echo $adjusted; // prints '3km'

```

You can also limit this adjustment to a littler scale :

```php
echo Scaler::adjust(3000, 'm')->toHecto(); // prints '30hm'

echo Scaler::adjust(3000, 'm')->toCenti(); // prints '300000cm'

```

The unit returned by Scaler is able to perform adjustment. So, adjustment can be done from any scale :

```php
echo Scaler::unit(30000, 'm')
    ->fromMilli()
    ->adjust()
    ->toKilo(); // prints '30m', amount is not enough to get to kilo

```



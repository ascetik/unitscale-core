Donc on a dejà des problèmes.

D'abord, on ne devrait pas pouvoir utiliser fromKekchose() sur un ScaleValue !

Disons qu'on a un ScaleValue avec son Scale bien défini. Pourquoi changer ce scale après coup ?
Donc, l'instance doit avoir son baseScale et ne doit pas pouvoir le changer.

Pour remédier à ça, il y a plusieurs choses

# ScaleValueFactory

C'est lui qui va devoir gérer les méthodes from.
Il faudra une methode __callStatic qui va devoir demander le selector à sa cible.

Par contre on garde les méthodes "to" sur le ScaleValue !

# Available commands

J'avais déjà qqs limitations.
Il va falloir faire de ces trucs des classes.
Je dois pouvoir avoir le choix entre des commandes TO, FROM, et autres eventualités de manière à utiliser la commande qu'il faut avec les méthodes dites magiques.

Quoique, à la réfléxion, on pourrait se demander s'il n'y a pas plus simple...

Si on récapitule, on va avoir:
- la factory qui fera qqchose avec *from*
- le ScaleValue qui fera qqch avec *to*
- le AdjustedValue qui pourait utiliser *as*
- et surement le AdjustedTimeVaue qui aura son *until* ou qqch du genre...

# Interpreter

Je crois que je me suis un peu égaré avec celui-là.
Il est juste là pour interpreter la commande interceptée par __call (ou __callStatic).
On y capte du :
- from
- to
- as
- until, eventuellement (HS)

On pourrait aveoir plusieurs implémentations d'un AvailableCommand, un pour chacun.
ou peut-etre plus simple.
Disons qu'on instancie l'interpreter avec un préfixe précis, 'from', 'to' ou autre.
L'interpreter devra reconnaitre ce prefixe dans la commande et retourner l'autre partie
pour savoir quelle méthode du selector appeler.

Si le prefixe ne correspond pas, on aura droit à une Exception qui dira kekc'estkcetteméthode
```php

class CommandChecker
{
    private readonly array $prefixes;

    public function __construct(string ...$prefixes)
    {
        $this->prefixes = $prefixes;
    }

    public function parse(string $method): string
    {
        foreach($this->prefixes as $prefix)
        {
            if(str_starts_with($method, $prefix))
            {
                return strtolower(substr($method, strlen($prefix)));
            }
        }
        throw new BadMethodCallException('unknown command');
    }
}

class Scaler
{
    public static function unit(int|float $value, Scale $scale = )
    public static function __callStatic(string $method, $args)
    {
        $checker = new CommandChecker('to');
        $command = $checker->parse($method);
        $scale = ScaleValue::createScale($checker->name());
        return $this->convertTo($scale);

    }
}
class ScaleValue
{
    public function __call(string $method, $args)
    {
        $checker = new CommandChecker('to');
        $command = $checker->parse($method);
        $scale = ScaleValue::createScale($checker->name());
        return $this->convertTo($scale);
        }
    }
}
```

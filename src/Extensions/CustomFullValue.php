<?php

namespace Ascetik\UnitscaleCore\Extensions;

use Ascetik\UnitscaleCore\DTO\ScaleReference;
use Ascetik\UnitscaleCore\Enums\ScaleCommandPrefix;
use Ascetik\UnitscaleCore\Parsers\ScaleCommandInterpreter;
use Ascetik\UnitscaleCore\Types\FullValue;
use Ascetik\UnitscaleCore\Types\Scale;
use Ascetik\UnitscaleCore\Values\CustomScaleValue;

class CustomFullValue implements FullValue
{
    private ScaleReference $reference;
    public function __construct(
        CustomScaleValue $value
    ) {
        $this->reference = new ScaleReference($value);
        /**
         * Au dernier essai, on utilisait un ScaleReference.
         * C'est toujours une bonne idée. Et du coup : on a deux choix :
         * - soit on donne notre value en constructeur et il se demerde avec un trait pour gerer sa reference
         * - soit c'est le ScaleValue qui forme le ScaleReference.
         *
         * Je préfère la première solution. ScaleValue n'a pas à s'occuper de la reference. Il ne connait que l'adjuster.
         * Alors comme avant, c'est un trait qui va gérer ça.
         * UseScaleReference me parait adapté.
         *
         * Et alors que gère la reference ?
         * Voilà ce que j'ai récupéré de l'ancien package :
         * - un ScaleContainer $container pour contenir tous les scales disponibles. initialisé au constructeur si pas donné
         * - un Scale nullable $maxScale
         * - un ScaleValue en public readonly
         *
         * C'est le FullValue qui doit gérer les appels from et to. L'opération est différente de nos amis les ScaleValues.
         * C'est le ScaleReference qui enregistre les limites.
         * Pour TimeScale j'avais prévu un from. Pour les CustomScales, c'est inutile. Il faut quand meme remettre en place ce qu'il faut pour ça.
         * Et donc, je dois limiter les appels "magiques" à to.
         * Pour le reste, je crois que le ScaleReference de base suffira. Il fonctionnait déjà très bien avant!
         * Mais on refait le code. Meme le trait. Il y a qqs petites choses qui ont changé.
         */
    }

    public function __call($name, $arguments): static
    {
        $parser = ScaleCommandInterpreter::get($name, ScaleCommandPrefix::TO);
        $limit = $this->reference->value::createScale($parser->action);
        $this->reference->limitTo($limit);
        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->reference->highest(); // TODO : à changer par le ScaleReference plus tard
    }

    public function raw(): int|float
    {
        return $this->reference->value->raw(); // TODO : à revoir peut-être
    }

    public function getScale(): Scale
    {
        return $this->reference->value->getScale(); // TODO : y revenir, donc
    }

    public function getUnit(): string
    {
        return $this->reference->value->getUnit(); // TODO : je me repete...
    }
}

<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\Config\RectorConfig;
use Rector\Nette\Rector\ClassMethod\RenderMethodParamToTypeDeclarationRector;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->rule(RenderMethodParamToTypeDeclarationRector::class);
};

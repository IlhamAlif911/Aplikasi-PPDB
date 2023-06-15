<?php

declare (strict_types=1);
namespace RectorPrefix20220609\Symplify\Astral\StaticFactory;

use RectorPrefix20220609\Symplify\Astral\Naming\SimpleNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\ArgNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\AttributeNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\ClassLikeNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\ClassMethodNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\ConstFetchNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\FuncCallNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\IdentifierNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\NamespaceNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\ParamNodeNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeNameResolver\PropertyNodeNameResolver;
/**
 * This would be normally handled by standard Symfony or Nette DI, but PHPStan does not use any of those, so we have to
 * make it manually.
 */
final class SimpleNameResolverStaticFactory
{
    public static function create() : SimpleNameResolver
    {
        $nameResolvers = [new ArgNodeNameResolver(), new AttributeNodeNameResolver(), new ClassLikeNodeNameResolver(), new ClassMethodNodeNameResolver(), new ConstFetchNodeNameResolver(), new FuncCallNodeNameResolver(), new IdentifierNodeNameResolver(), new NamespaceNodeNameResolver(), new ParamNodeNameResolver(), new PropertyNodeNameResolver()];
        return new SimpleNameResolver($nameResolvers);
    }
}

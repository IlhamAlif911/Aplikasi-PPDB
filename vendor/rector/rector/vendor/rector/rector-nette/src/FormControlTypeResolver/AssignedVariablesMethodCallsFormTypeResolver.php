<?php

declare (strict_types=1);
namespace Rector\Nette\FormControlTypeResolver;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Variable;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Nette\Contract\FormControlTypeResolverInterface;
use Rector\Nette\NodeResolver\MethodNamesByInputNamesResolver;
use RectorPrefix20220609\Symfony\Contracts\Service\Attribute\Required;
final class AssignedVariablesMethodCallsFormTypeResolver implements FormControlTypeResolverInterface
{
    /**
     * @var \Rector\Nette\NodeResolver\MethodNamesByInputNamesResolver
     */
    private $methodNamesByInputNamesResolver;
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\Node\BetterNodeFinder
     */
    private $betterNodeFinder;
    public function __construct(BetterNodeFinder $betterNodeFinder)
    {
        $this->betterNodeFinder = $betterNodeFinder;
    }
    /**
     * @required
     */
    public function autowire(MethodNamesByInputNamesResolver $methodNamesByInputNamesResolver) : void
    {
        $this->methodNamesByInputNamesResolver = $methodNamesByInputNamesResolver;
    }
    /**
     * @return array<string, string>
     */
    public function resolve(Node $node) : array
    {
        if (!$node instanceof Variable) {
            return [];
        }
        $formVariableAssign = $this->betterNodeFinder->findPreviousAssignToExpr($node);
        if (!$formVariableAssign instanceof Assign) {
            return [];
        }
        return $this->methodNamesByInputNamesResolver->resolveExpr($formVariableAssign->expr);
    }
}

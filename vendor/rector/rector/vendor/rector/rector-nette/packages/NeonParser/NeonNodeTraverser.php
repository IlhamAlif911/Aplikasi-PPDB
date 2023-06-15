<?php

declare (strict_types=1);
namespace Rector\Nette\NeonParser;

use RectorPrefix20220609\Nette\Neon\Node;
use Rector\Nette\Contract\Rector\NeonRectorInterface;
use Rector\Nette\NeonParser\Contract\NeonNodeVisitorInterface;
use Rector\Nette\NeonParser\Node\Service_;
use Rector\Nette\NeonParser\NodeFactory\ServiceFactory;
use Rector\Nette\NeonParser\Services\ServiceTypeResolver;
/**
 * @see https://forum.nette.org/en/34804-neon-with-ast-parser-and-format-preserving-printing
 */
final class NeonNodeTraverser
{
    /**
     * @var NeonNodeVisitorInterface[]
     */
    private $neonRectors = [];
    /**
     * @var \Rector\Nette\NeonParser\Services\ServiceTypeResolver
     */
    private $serviceTypeResolver;
    /**
     * @var \Rector\Nette\NeonParser\NodeFactory\ServiceFactory
     */
    private $serviceFactory;
    public function __construct(ServiceTypeResolver $serviceTypeResolver, ServiceFactory $serviceFactory)
    {
        $this->serviceTypeResolver = $serviceTypeResolver;
        $this->serviceFactory = $serviceFactory;
    }
    public function addNeonNodeVisitor(NeonRectorInterface $neonRector) : void
    {
        $this->neonRectors[] = $neonRector;
    }
    public function traverse(Node $node) : Node
    {
        foreach ($this->neonRectors as $neonRector) {
            // is service node?
            // iterate single service
            $serviceType = $this->serviceTypeResolver->resolve($node);
            // create virtual node
            if (\is_string($serviceType)) {
                $service = $this->serviceFactory->create($node);
                if ($service instanceof Service_) {
                    // enter meta node
                    $node = $service;
                }
            }
            // enter node only in case of matching type
            if (\is_a($node, $neonRector->getNodeType(), \true)) {
                $neonRector->enterNode($node);
            }
            // traverse all children
            foreach ($node->getIterator() as $subnode) {
                $this->traverse($subnode);
            }
        }
        return $node;
    }
}

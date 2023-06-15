<?php

declare (strict_types=1);
namespace Rector\CodingStyle\Reflection;

use PHPStan\Reflection\MethodReflection;
use RectorPrefix20220609\Symplify\SmartFileSystem\Normalizer\PathNormalizer;
final class VendorLocationDetector
{
    /**
     * @readonly
     * @var \Symplify\SmartFileSystem\Normalizer\PathNormalizer
     */
    private $pathNormalizer;
    public function __construct(PathNormalizer $pathNormalizer)
    {
        $this->pathNormalizer = $pathNormalizer;
    }
    public function detectMethodReflection(MethodReflection $methodReflection) : bool
    {
        $declaringClassReflection = $methodReflection->getDeclaringClass();
        $fileName = $declaringClassReflection->getFileName();
        // probably internal
        if ($fileName === null) {
            return \false;
        }
        $normalizedFileName = $this->pathNormalizer->normalizePath($fileName);
        return \strpos($normalizedFileName, '/vendor/') !== \false;
    }
}

<?php

declare (strict_types=1);
namespace Rector\Parallel;

use RectorPrefix20220609\Clue\React\NDJson\Decoder;
use RectorPrefix20220609\Clue\React\NDJson\Encoder;
use PHPStan\Analyser\NodeScopeResolver;
use Rector\Core\Application\FileProcessor\PhpFileProcessor;
use Rector\Core\Provider\CurrentFileProvider;
use Rector\Core\StaticReflection\DynamicSourceLocatorDecorator;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Configuration;
use Rector\Core\ValueObject\Error\SystemError;
use Rector\Parallel\ValueObject\Bridge;
use RectorPrefix20220609\Symplify\EasyParallel\Enum\Action;
use RectorPrefix20220609\Symplify\EasyParallel\Enum\ReactCommand;
use RectorPrefix20220609\Symplify\EasyParallel\Enum\ReactEvent;
use RectorPrefix20220609\Symplify\PackageBuilder\Yaml\ParametersMerger;
use RectorPrefix20220609\Symplify\SmartFileSystem\SmartFileInfo;
use Throwable;
final class WorkerRunner
{
    /**
     * @var string
     */
    private const RESULT = 'result';
    /**
     * @readonly
     * @var \Symplify\PackageBuilder\Yaml\ParametersMerger
     */
    private $parametersMerger;
    /**
     * @readonly
     * @var \Rector\Core\Provider\CurrentFileProvider
     */
    private $currentFileProvider;
    /**
     * @readonly
     * @var \Rector\Core\Application\FileProcessor\PhpFileProcessor
     */
    private $phpFileProcessor;
    /**
     * @readonly
     * @var \PHPStan\Analyser\NodeScopeResolver
     */
    private $nodeScopeResolver;
    /**
     * @readonly
     * @var \Rector\Core\StaticReflection\DynamicSourceLocatorDecorator
     */
    private $dynamicSourceLocatorDecorator;
    public function __construct(ParametersMerger $parametersMerger, CurrentFileProvider $currentFileProvider, PhpFileProcessor $phpFileProcessor, NodeScopeResolver $nodeScopeResolver, DynamicSourceLocatorDecorator $dynamicSourceLocatorDecorator)
    {
        $this->parametersMerger = $parametersMerger;
        $this->currentFileProvider = $currentFileProvider;
        $this->phpFileProcessor = $phpFileProcessor;
        $this->nodeScopeResolver = $nodeScopeResolver;
        $this->dynamicSourceLocatorDecorator = $dynamicSourceLocatorDecorator;
    }
    public function run(Encoder $encoder, Decoder $decoder, Configuration $configuration) : void
    {
        $this->dynamicSourceLocatorDecorator->addPaths($configuration->getPaths());
        // 1. handle system error
        $handleErrorCallback = static function (Throwable $throwable) use($encoder) : void {
            $systemErrors = new SystemError($throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
            $encoder->write([ReactCommand::ACTION => Action::RESULT, self::RESULT => [Bridge::SYSTEM_ERRORS => [$systemErrors], Bridge::FILES_COUNT => 0, Bridge::SYSTEM_ERRORS_COUNT => 1]]);
            $encoder->end();
        };
        $encoder->on(ReactEvent::ERROR, $handleErrorCallback);
        // 2. collect diffs + errors from file processor
        $decoder->on(ReactEvent::DATA, function (array $json) use($encoder, $configuration) : void {
            $action = $json[ReactCommand::ACTION];
            if ($action !== Action::MAIN) {
                return;
            }
            $systemErrorsCount = 0;
            /** @var string[] $filePaths */
            $filePaths = $json[Bridge::FILES] ?? [];
            $errorAndFileDiffs = [];
            $systemErrors = [];
            // 1. allow PHPStan to work with static reflection on provided files
            $this->nodeScopeResolver->setAnalysedFiles($filePaths);
            foreach ($filePaths as $filePath) {
                try {
                    $smartFileInfo = new SmartFileInfo($filePath);
                    $file = new File($smartFileInfo, $smartFileInfo->getContents());
                    $this->currentFileProvider->setFile($file);
                    if (!$this->phpFileProcessor->supports($file, $configuration)) {
                        continue;
                    }
                    $currentErrorsAndFileDiffs = $this->phpFileProcessor->process($file, $configuration);
                    $errorAndFileDiffs = $this->parametersMerger->merge($errorAndFileDiffs, $currentErrorsAndFileDiffs);
                } catch (Throwable $throwable) {
                    ++$systemErrorsCount;
                    $errorMessage = \sprintf('System error: "%s"', $throwable->getMessage()) . \PHP_EOL;
                    $errorMessage .= 'Run Rector with "--debug" option and post the report here: https://github.com/rectorphp/rector/issues/new';
                    $systemErrors[] = new SystemError($errorMessage, $filePath, $throwable->getLine());
                }
            }
            /**
             * this invokes all listeners listening $decoder->on(...) @see \Symplify\EasyParallel\Enum\ReactEvent::DATA
             */
            $encoder->write([ReactCommand::ACTION => Action::RESULT, self::RESULT => [Bridge::FILE_DIFFS => $errorAndFileDiffs[Bridge::FILE_DIFFS] ?? [], Bridge::FILES_COUNT => \count($filePaths), Bridge::SYSTEM_ERRORS => $systemErrors, Bridge::SYSTEM_ERRORS_COUNT => $systemErrorsCount]]);
        });
        $decoder->on(ReactEvent::ERROR, $handleErrorCallback);
    }
}

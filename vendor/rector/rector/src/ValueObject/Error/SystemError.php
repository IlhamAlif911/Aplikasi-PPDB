<?php

declare (strict_types=1);
namespace Rector\Core\ValueObject\Error;

use Rector\Parallel\ValueObject\Name;
use RectorPrefix20220609\Symplify\EasyParallel\Contract\SerializableInterface;
final class SystemError implements SerializableInterface
{
    /**
     * @readonly
     * @var string
     */
    private $message;
    /**
     * @readonly
     * @var string|null
     */
    private $relativeFilePath = null;
    /**
     * @readonly
     * @var int|null
     */
    private $line = null;
    /**
     * @readonly
     * @var string|null
     */
    private $rectorClass = null;
    /**
     * @param string|null $relativeFilePath
     * @param int|null $line
     * @param string|null $rectorClass
     */
    public function __construct(string $message, $relativeFilePath = null, $line = null, $rectorClass = null)
    {
        $this->message = $message;
        $this->relativeFilePath = $relativeFilePath;
        $this->line = $line;
        $this->rectorClass = $rectorClass;
    }
    public function getMessage() : string
    {
        return $this->message;
    }
    /**
     * @return string|null
     */
    public function getFile()
    {
        return $this->relativeFilePath;
    }
    /**
     * @return int|null
     */
    public function getLine()
    {
        return $this->line;
    }
    public function getFileWithLine() : string
    {
        return $this->relativeFilePath . ':' . $this->line;
    }
    public function getRelativeFilePath() : ?string
    {
        return $this->relativeFilePath;
    }
    /**
     * @return array{message: string, relative_file_path: string|null, line: int|null, rector_class: string|null}
     */
    public function jsonSerialize() : array
    {
        return [Name::MESSAGE => $this->message, Name::RELATIVE_FILE_PATH => $this->relativeFilePath, Name::LINE => $this->line, Name::RECTOR_CLASS => $this->rectorClass];
    }
    /**
     * @param mixed[] $json
     */
    public static function decode(array $json) : SerializableInterface
    {
        return new self($json[Name::MESSAGE], $json[Name::RELATIVE_FILE_PATH], $json[Name::LINE], $json[Name::RECTOR_CLASS]);
    }
    public function getRectorClass() : ?string
    {
        return $this->rectorClass;
    }
}

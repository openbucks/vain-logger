<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-logger
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-logger
 */
declare(strict_types = 1);

namespace Vain\Logger\Formatter;

use Monolog\Formatter\LineFormatter;

/**
 * Class MonologLineFormatter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MonologLineFormatter extends LineFormatter
{
    const EXTENDED_FORMAT = "[%datetime%] %channel%.%level_name%: %message%\n";

    /**
     * MonologLineFormatter constructor.
     *
     * @param null|string $dateFormat
     * @param null|string $allowInlineLineBreaks
     * @param bool        $ignoreEmptyContextAndExtra
     */
    public function __construct($dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra)
    {
        parent::__construct(self::EXTENDED_FORMAT, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
    }
}
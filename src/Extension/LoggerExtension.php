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

namespace Vain\Logger\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vain\Core\Extension\AbstractExtension;
use Vain\Logger\Extension\Compiler\LoggerHandlerCompilerPass;

/**
 * Class LoggerExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container) : AbstractExtension
    {
        $container->addCompilerPass(new LoggerHandlerCompilerPass());

        return parent::load($configs, $container);
    }
}

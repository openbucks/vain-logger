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

namespace Vain\Logger\Extension\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class LoggerHandlerCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerHandlerCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        /**
         * @var Definition[] $definitions
         */
        $definitions = $container->findTaggedServiceIds('logger');
        $services = $container->findTaggedServiceIds('logger.handler');
        foreach ($definitions as $definition => $description) {
            foreach ($services as $id => $tags) {
                $container->findDefinition($definition)->addMethodCall('addHandler', [new Reference($id)]);
            }
        }

        return $this;
    }
}

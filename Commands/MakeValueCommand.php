<?php

/**
 * Created by PhpStorm.
 * User: ziqing
 * Date: 2018/5/24
 * Time: 下午1:14
 */

namespace ziqing\ddd\tool;

use ziqing\ddd\tool\traits\CollectPropertiesFromConsoleTrait;
use ziqing\ddd\tool\traits\DataGenerateTrait;
use ziqing\ddd\tool\traits\DealClassFileNameTrait;
use ziqing\ddd\tool\traits\GetInputFromConsoleTrait;
use ziqing\ddd\tool\traits\PreviewTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeValueCommand extends BaseCommand
{
    use DataGenerateTrait;
    use DealClassFileNameTrait;
    use GetInputFromConsoleTrait;
    use CollectPropertiesFromConsoleTrait;
    use PreviewTrait;

    protected $generatorType = 'values';
    protected $classNameSuffix = '';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:value 
                                {className : 指定值对象类名称}
                                {--sub-domain=Core : 指定值对象所属子域(首字母大写，默认核心子域)} 
                                {--preview : 预览，不写入文件}
                                ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make a Domain Value class';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $subDomain = $this->getSubDomainFromConsole();
        $className = $this->getClassNameFromConsole();
        $this->setPackage($subDomain);
        $this->setClassName($className);

        $filename = $this->getFilename();
        $this->doConfirmWhenFileExists($filename);

        if ($this->confirm("Do you want to add an attribute now?")) {
            $this->collectPropertiesFromConsole();
        }

        $template = file_get_contents(__DIR__ . "/../templates/Value.tpl");
        $content  = $this->buildFileContent($template);

        $this->previewOrWriteNow($filename, $content);
        return 0;
    }
}

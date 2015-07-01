<?php


namespace dicom\workflow\rules;
use dicom\workflow\rules\RuleInterface\IRuleCheckingOneValue;
use dicom\workflow\rules\RuleInterface\IConfiguredRule;
use dicom\workflow\rules\exception\RuleExecutionException;


/**
 * Class GreaterThan
 *
 * Проверяет что новое значение сущности больше опредленного значения, заданого в конфиге Workflow
 *
 * @package dicom\workflow\rules
 */
class Lte extends RuleCheckingOneValue implements IRuleCheckingOneValue, IConfiguredRule
{
    use ConfiguredRule{
        ConfiguredRule::validateConfig as configuratorValidateConfig;
    }

    /**
     * Проверить удовлятеворяют ли переданые значения правилу
     *
     * @param null|mixed $entityNewValue

     * @return mixed
     */
    protected function isValid($entityNewValue = null)
    {
        return $entityNewValue <= $this->getConfiguredValue();
    }

    /**
     * Создать Exception, описывающий ошибку проверки
     *
     * @param null $value
     *
     * @return mixed
     */
    protected function constructValidationException($value = null)
    {
        $e = new RuleExecutionException(sprintf('Value must be greater than 0. Given: %s', $value));
        $e->setHumanFriendlyMessage('Must be greater than 0');
        return $e;
    }


    protected function validateConfig($config)
    {
        if ($this->configuratorValidateConfig($config)) {
            return true;
        }

        if ( is_numeric($config)) {
            return true;
        }

        throw $this->createConfigurationException('config for must be a numeric or Expression', $config);
    }

}
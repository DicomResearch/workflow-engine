<?php

namespace workflow\rules\executionResult;


use workflow\rules\exception\RuleExecutionException;
use workflow\rules\RuleInterface\IRule;

/**
 * Result of rule execution
 *
 * it contains rule is success, error if not success
 *
 * @package workflow\rules\executionResult
 */
class RuleExecutionResult
{
    /**
     * @var IRule
     */
    protected $rule;

    /**
     * @var bool
     */
    protected $resultIsSuccess;

    /**
     * @var RuleExecutionException
     */
    protected $error;

    public function __construct(IRule $rule)
    {
        $this->setRule($rule);
    }

    /**
     * return a name of rule
     *
     * @return string
     */
    public function getRuleName()
    {
        return $this->getRule()->getName();
    }

    /**
     * @return IRule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param IRule $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->resultIsSuccess;
    }

    /**
     * @param boolean $resultIsSuccess
     */
    public function setResult($resultIsSuccess)
    {
        $this->resultIsSuccess = $resultIsSuccess;
    }

    /**
     * @return RuleExecutionException
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param RuleExecutionException $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }


}
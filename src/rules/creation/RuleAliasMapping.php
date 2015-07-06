<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.11.14
 * Time: 10:14
 */

namespace dicom\workflow\rules\creation;

use dicom\workflow\rules\exception\PropertyRuleMappingException;

class RuleAliasMapping
{
    private static $ruleNameMapping = [
        'readonly'              => 'dicom\workflow\rules\PropertyIsReadOnlyRule',
        'required'              => 'dicom\workflow\rules\PropertyIsRequiredRule',
        'empty'                 => 'dicom\workflow\rules\IsEmptyRule',
        'alwaystrue'            => 'dicom\workflow\rules\AlwaysTrueRule',
        'alwaysfalse'           => 'dicom\workflow\rules\AlwaysFalseRule',
        'in'                    => '\dicom\workflow\rules\InRule',
        'yiicheckaccess'        => '\dicom\workflow\rules\YiiCheckAccess',
        'currentuserisreceiver' => '\dicom\workflow\rules\CurrentUserIsReceiver',
        'between'               => 'dicom\workflow\rules\BetweenRule',
        'notbetween'            => 'dicom\workflow\rules\NotBetweenRule',
        'eq'                    => 'dicom\workflow\rules\compare\EqRule',
        'gte'                   => 'dicom\workflow\rules\compare\GteRule',
        'gt'                    => 'dicom\workflow\rules\compare\GtRule',
        'lte'                   => 'dicom\workflow\rules\compare\LteRule',
        'lt'                   => 'dicom\workflow\rules\compare\LtRule',
    ];

    public static function getClassNameByAlias($alias)
    {
        $alias = strtolower($alias);

        if (!array_key_exists($alias, static::$ruleNameMapping)) {
            throw PropertyRuleMappingException::cantMapRuleName($alias, static::$ruleNameMapping);
        }

        return static::$ruleNameMapping[$alias];
    }

    public static function getAliasByClassName($className)
    {
        if (!in_array($className, static::$ruleNameMapping)) {
            throw PropertyRuleMappingException::cantMapClassName($className, static::$ruleNameMapping);
        }

        $alias = array_search($className, static::$ruleNameMapping);
        return $alias;
    }

    public static function addAlias($alias, $className)
    {
        $alias = strtolower($alias);

        if (array_key_exists($alias, static::$ruleNameMapping)) {
            PropertyRuleMappingException::aliasAlreadyRegistered($alias);
        }

        static::$ruleNameMapping[$alias] = $className;
    }

} 
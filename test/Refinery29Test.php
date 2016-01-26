<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Refinery29;
use Symfony\CS\ConfigInterface;

class Refinery29Test extends \PHPUnit_Framework_TestCase
{
    public function testImplementsInterface()
    {
        $config = new Refinery29();

        $this->assertInstanceOf(ConfigInterface::class, $config);
    }

    public function testValues()
    {
        $config = new Refinery29();

        $this->assertSame('refinery29', $config->getName());
        $this->assertSame('The configuration for Refinery29 PHP applications', $config->getDescription());
        $this->assertTrue($config->usingCache());
        $this->assertTrue($config->usingLinter());
        $this->assertFalse($config->getRiskyAllowed());
    }

    public function testHasPsr2Rules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getPsr2Rules(),
            $config->getRules(),
            'PSR2'
        );
    }

    public function testHasSymfonyRules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getSymfonyRules(),
            $config->getRules(),
            'Symfony'
        );
    }

    public function testHasContribRules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getContribRules(),
            $config->getRules(),
            'Contrib'
        );
    }

    public function testDoesNotHaveHeaderCommentFixerByDefault()
    {
        $config = new Refinery29();

        $rules = $config->getRules();

        $this->assertArrayHasKey('header_comment', $rules);
        $this->assertFalse($rules['header_comment']);
    }

    public function testHasHeaderCommentFixerIfProvided()
    {
        $header = 'foo';

        $config = new Refinery29($header);

        $rules = $config->getRules();

        $this->assertArrayHasKey('header_comment', $rules);

        $expected = [
            'header' => $header,
        ];

        $this->assertSame($expected, $rules['header_comment']);
    }

    /**
     * @param array  $expected
     * @param array  $actual
     * @param string $set
     */
    private function assertHasRules(array $expected, array $actual, $set)
    {
        foreach ($expected as $fixer => $isEnabled) {
            $this->assertArrayHasKey($fixer, $actual, sprintf(
                'Failed to assert that a rule for fixer "%s" (in set "%s") exists.,',
                $fixer,
                $set
            ));

            $this->assertSame($isEnabled, $actual[$fixer], sprintf(
                'Failed to assert that fixer "%s" (in set "%s") is %s.',
                $fixer,
                $set,
                $isEnabled === true ? 'enabled' : 'disabled'
            ));
        }
    }

    /**
     * @dataProvider providerDoesNotHaveFixerEnabled
     *
     * @param string $fixer
     * @param string $reason
     */
    public function testDoesNotHaveRulesEnabled($fixer, $reason)
    {
        $config = new Refinery29();

        $rule = [
            $fixer => false,
        ];

        $this->assertArraySubset($rule, $config->getRules(), true, sprintf(
            'Fixer "%s" should not be enabled, because "%s"',
            $fixer,
            $reason
        ));
    }

    /**
     * @return array
     */
    public function providerDoesNotHaveFixerEnabled()
    {
        $fixers = [
            'align_double_arrow' => 'it conflicts with unalign_double_arrow (which is enabled)',
            'align_equals' => 'it conflicts with unalign_double (yet to be enabled)',
            'concat_without_spaces' => 'it conflicts with concat_with_spaces (which is enabled)',
            'header_comment' => 'it is not enabled by default',
            'ereg_to_preg' => 'it changes behaviour',
            'logical_not_operators_with_spaces' => 'we do not need leading and trailing whitespace before !',
            'logical_not_operators_with_successor_space' => 'we have not decided to use this one (yet)',
            'long_array_syntax' => 'it conflicts with short_array_syntax (which is enabled)',
            'php4_constructor' => 'it may change behaviour',
            'php_unit_construct' => 'it may change behaviour',
            'php_unit_strict' => 'it may change behaviour',
            'phpdoc_var_to_type' => 'it conflicts with phpdoc_type_to_var (which is enabled)',
            'self_accessor' => 'it causes an edge case error',
        ];

        $data = [];

        foreach ($fixers as $fixer => $reason) {
            $data[] = [
                $fixer,
                $reason,
            ];
        }

        return $data;
    }

    /**
     * @return array
     */
    private function getPsr2Rules()
    {
        return [
            '@PSR2' => true,
        ];
    }

    /**
     * @return array
     */
    private function getSymfonyRules()
    {
        return [
            'blank_line_after_opening_tag' => true,
            'blank_line_before_return' => true,
            'binary_operator_spaces' => true,
            'concat_without_spaces' => false,
            'double_arrow_no_multiline_whitespace' => true,
            'function_typehint_space' => true,
            'include' => true,
            'hash_to_slash_comment' => true,
            'method_separation' => true,
            'native_function_casing' => true,
            'new_with_braces' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_between_uses' => true,
            'no_duplicate_semicolons' => true,
            'no_leading_import_slash' => true,
            'no_short_bool_cast' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_trailing_whitespace' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unused_imports' => true,
            'no_whitespace_before_comma_in_array' => true,
            'object_operator_without_whitespace' => true,
            'ordered_imports' => true,
            'phpdoc_align' => true,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_package' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_type_to_var' => true,
            'phpdoc_var_without_name' => true,
            'pre_increment' => true,
            'self_accessor' => false,
            'short_scalar_cast' => true,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'space_after_semicolon' => true,
            'spaces_cast' => true,
            'standardize_not_equals' => true,
            'ternary_operator_spaces' => true,
            'trim_array_spaces' => true,
            'unalign_double_arrow' => true,
            'unalign_equals' => true,
            'unary_operator_spaces' => true,
            'whitespacy_lines' => true,
        ];
    }

    /**
     * @return array
     */
    protected function getContribRules()
    {
        return [
            'align_double_arrow' => false,
            'align_equals' => false,
            'blank_line_after_opening_tag' => true,
            'concat_with_spaces' => true,
            'ereg_to_preg' => false,
            'header_comment' => false,
            'logical_not_operators_with_spaces' => false,
            'logical_not_operators_with_successor_space' => false,
            'long_array_syntax' => false,
            'multiline_spaces_before_semicolon' => false,
            'no_blank_lines_before_namespace' => false,
            'no_short_echo_tag' => true,
            'ordered_imports' => true,
            'php4_constructor' => false,
            'php_unit_construct' => false,
            'php_unit_strict' => false,
            'phpdoc_order' => true,
            'phpdoc_var_to_type' => false,
            'psr0' => false,
            'short_array_syntax' => true,
            'strict' => false,
            'strict_param' => false,
        ];
    }
}

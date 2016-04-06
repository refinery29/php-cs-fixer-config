<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config\Test;

use PhpCsFixer\ConfigInterface;
use Refinery29\CS\Config\Refinery29;

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
            /*
             * Symfony
             */
            'concat_without_spaces' => 'it conflicts with concat_with_spaces (which is enabled)',
            'heredoc_to_nowdoc' => 'we have not decided to use this one (yet)',
            'self_accessor' => 'it causes an edge case error',
            'phpdoc_summary' => 'we have not decided to use this one (yet)',
            /*
             * Contrib
             */
            'align_double_arrow' => 'it conflicts with unalign_double_arrow (which is enabled)',
            'align_equals' => 'it conflicts with unalign_double (yet to be enabled)',
            'dir_constant' => 'it is a risky fixer',
            'echo_to_print' => 'we have not decided to use this one (yet)',
            'ereg_to_preg' => 'it changes behaviour',
            'header_comment' => 'it is not enabled by default',
            'long_array_syntax' => 'it conflicts with short_array_syntax (which is enabled)',
            'modernize_types_casting' => 'it is a risky fixer',
            'no_blank_lines_before_namespace' => 'it conflicts with single_blank_line_before_namespace fixer',
            'no_multiline_whitespaces_before_semicolon' => 'we have not decided to use this one (yet)',
            'no_php4_constructor' => 'it changes behaviour',
            'not_operators_with_space' => 'we do not need leading and trailing whitespace before !',
            'not_operator_with_successor_space' => 'we have not decided to use this one (yet)',
            'ordered_class_elements' => 'we have not decided to use this one (yet)',
            'phpdoc_property' => 'we have not decided to use this one (yet)',
            'phpdoc_var_to_type' => 'it conflicts with phpdoc_type_to_var (which is enabled)',
            'php_unit_construct' => 'it changes behaviour',
            'php_unit_dedicate_assert' => 'it is a risky fixer',
            'php_unit_strict' => 'it changes behaviour',
            'print_to_echo' => 'we have not decided to use this one (yet)',
            'psr0' => 'we are using PSR-4',
            'random_api_migration' => 'it is a risky fixer',
            'strict_comparison' => 'it changes behaviour',
            'strict_param' => 'it changes behaviour',
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
            'cast_spaces' => true,
            'concat_without_spaces' => false,
            'function_typehint_space' => true,
            'hash_to_slash_comment' => true,
            'heredoc_to_nowdoc' => false,
            'include' => true,
            'lowercase_cast' => true,
            'method_separation' => true,
            'native_function_casing' => true,
            'new_with_braces' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_blank_lines_between_uses' => true,
            'no_duplicate_semicolons' => true,
            'no_empty_statement' => true,
            'no_extra_consecutive_blank_lines' => true,
            'no_leading_import_slash' => true,
            'no_leading_namespace_whitespace' => true,
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_short_bool_cast' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unreachable_default_argument_value' => true,
            'no_unused_imports' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_lines' => true,
            'object_operator_without_whitespace' => true,
            'phpdoc_align' => true,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_type_to_var' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'pre_increment' => true,
            'print_to_echo' => false,
            'self_accessor' => false,
            'short_scalar_cast' => true,
            'simplified_null_return' => true,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'space_after_semicolon' => true,
            'standardize_not_equals' => true,
            'ternary_operator_spaces' => true,
            'trailing_comma_in_multiline_array' => true,
            'trim_array_spaces' => true,
            'unalign_double_arrow' => true,
            'unalign_equals' => true,
            'unary_operator_spaces' => true,
            'whitespace_after_comma_in_array' => true,
        ];
    }

    /**
     * @return array
     */
    private function getContribRules()
    {
        return [
            'align_double_arrow' => false,
            'align_equals' => false,
            'combine_consecutive_unsets' => true,
            'concat_with_spaces' => true,
            'ereg_to_preg' => false,
            'echo_to_print' => false,
            'header_comment' => false,
            'linebreak_after_opening_tag' => true,
            'long_array_syntax' => false,
            'no_blank_lines_before_namespace' => false,
            'no_empty_comment' => true,
            'no_multiline_whitespaces_before_semicolon' => false,
            'no_php4_constructor' => false,
            'no_short_echo_tag' => true,
            'no_useless_return' => true,
            'not_operators_with_space' => false,
            'not_operator_with_successor_space' => false,
            'ordered_class_elements' => false,
            'ordered_imports' => true,
            'phpdoc_order' => true,
            'phpdoc_property' => false,
            'phpdoc_var_to_type' => false,
            'php_unit_construct' => false,
            'php_unit_strict' => false,
            'psr0' => false,
            'short_array_syntax' => true,
            'strict_comparison' => false,
            'strict_param' => false,
        ];
    }
}

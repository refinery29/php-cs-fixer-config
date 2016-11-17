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
        $this->assertTrue($config->getRiskyAllowed());
    }

    public function testHasRules()
    {
        $config = new Refinery29();

        $this->assertEquals($this->getRules(), $config->getRules());
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
     * @return array
     */
    private function getRules()
    {
        return [
            '@PSR2' => true,
            'align_double_arrow' => false, // conflicts with unalign_double_arrow (which is enabled)
            'align_equals' => false, // conflicts with unalign_double (yet to be enabled)
            'binary_operator_spaces' => true,
            'blank_line_after_opening_tag' => true,
            'blank_line_before_return' => true,
            'cast_spaces' => true,
            'combine_consecutive_unsets' => true,
            'concat_with_spaces' => true,
            'concat_without_spaces' => false, // conflicts with concat_with_spaces (which is enabled)
            'dir_constant' => false, // risky
            'echo_to_print' => false, // have not decided to use this one (yet)
            'ereg_to_preg' => false, // risky
            'function_typehint_space' => true,
            'hash_to_slash_comment' => true,
            'header_comment' => false, // not enabled by default
            'heredoc_to_nowdoc' => false, // have not decided to use this one (yet)
            'include' => true,
            'linebreak_after_opening_tag' => true,
            'long_array_syntax' => false, // conflicts with short_array_syntax (which is enabled)
            'lowercase_cast' => true,
            'method_separation' => true,
            'modernize_types_casting' => true,
            'native_function_casing' => true,
            'new_with_braces' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_blank_lines_before_namespace' => false, // conflicts with single_blank_line_before_namespace (which is enabled)
            'no_empty_comment' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_consecutive_blank_lines' => true,
            'no_leading_import_slash' => true,
            'no_leading_namespace_whitespace' => true,
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_multiline_whitespace_before_semicolons' => true,
            'no_php4_constructor' => false, // risky
            'no_short_bool_cast' => true,
            'no_short_echo_tag' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_inside_offset' => true,
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unreachable_default_argument_value' => true,
            'no_unused_imports' => true,
            'no_useless_else' => false, // has issues with edge cases, see https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/1923
            'no_useless_return' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_lines' => true,
            'not_operator_with_space' => false, // have decided not to use it
            'not_operator_with_successor_space' => false, // have decided not to use it
            'object_operator_without_whitespace' => true,
            'ordered_class_elements' => false, // have decided not to use it, impossible to review in large legacy code base
            'ordered_imports' => true,
            'php_unit_construct' => false, // risky
            'php_unit_dedicate_assert' => false, // risky
            'php_unit_strict' => false, // risky
            'phpdoc_align' => true,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_order' => true,
            'phpdoc_property' => false, // have not decided to use this one (yet)
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => true,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_type_to_var' => true,
            'phpdoc_types' => true,
            'phpdoc_var_to_type' => false, // conflicts with phpdoc_type_to_var (which is enabled)
            'phpdoc_var_without_name' => true,
            'pre_increment' => true,
            'print_to_echo' => false, // have not decided to use this one (yet)
            'psr0' => false, // using PSR-4
            'random_api_migration' => false, // risky
            'self_accessor' => false, // it causes an edge case error
            'short_array_syntax' => true,
            'short_scalar_cast' => true,
            'simplified_null_return' => true,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'space_after_semicolon' => true,
            'standardize_not_equals' => true,
            'strict_comparison' => false, // risky
            'strict_param' => false, // risky
            'ternary_operator_spaces' => true,
            'trailing_comma_in_multiline_array' => true,
            'trim_array_spaces' => true,
            'unalign_double_arrow' => true,
            'unalign_equals' => true,
            'unary_operator_spaces' => true,
            'whitespace_after_comma_in_array' => true,
        ];
    }
}

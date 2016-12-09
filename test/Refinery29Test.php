<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config\Test;

use PhpCsFixer\ConfigInterface;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet;
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
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
    }

    public function testHasRules()
    {
        $config = new Refinery29();

        $this->assertEquals($this->getRules(), $config->getRules());
    }

    public function testAllConfiguredRulesAreBuiltIn()
    {
        $fixersNotBuiltIn = array_diff(
            $this->configuredFixers(),
            $this->builtInFixers()
        );

        $this->assertEmpty($fixersNotBuiltIn, sprintf(
            'Failed to assert that fixers for the rules "%s" are built in',
            implode('", "', $fixersNotBuiltIn)
        ));
    }

    public function testAllBuiltInRulesAreConfigured()
    {
        $fixersWithoutConfiguration = array_diff(
            $this->builtInFixers(),
            $this->configuredFixers()
        );

        $this->assertEmpty($fixersWithoutConfiguration, sprintf(
            'Failed to assert that built-in fixers for the rules "%s" are configured',
            implode('", "', $fixersWithoutConfiguration)
        ));
    }

    /**
     * @return string[]
     */
    private function builtInFixers()
    {
        $fixerFactory = FixerFactory::create();
        $fixerFactory->registerBuiltInFixers();

        $reflection = new \ReflectionProperty(FixerFactory::class, 'fixersByName');
        $reflection->setAccessible(true);

        return array_keys($reflection->getValue($fixerFactory));
    }

    /**
     * @return string[]
     */
    private function configuredFixers()
    {
        $config = new Refinery29();

        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = array_map(function () {
            return true;
        }, $config->getRules());

        return array_keys(RuleSet::create($rules)->getRules());
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
            'array_syntax' => [
                'syntax' => 'short',
            ],
            'binary_operator_spaces' => [
                'align_double_arrow' => false,
                'align_equals' => false,
            ],
            'blank_line_after_opening_tag' => true,
            'blank_line_before_return' => true,
            'cast_spaces' => true,
            'class_keyword_remove' => false,
            'combine_consecutive_unsets' => true,
            'concat_space' => [
                'spacing' => 'one',
            ],
            'declare_equal_normalize' => true,
            'declare_strict_types' => true,
            'dir_constant' => false, // risky
            'ereg_to_preg' => false, // risky
            'function_typehint_space' => true,
            'general_phpdoc_annotation_remove' => false, // have not decided to use this one (yet)
            'hash_to_slash_comment' => true,
            'header_comment' => false, // not enabled by default
            'heredoc_to_nowdoc' => false, // have not decided to use this one (yet)
            'include' => true,
            'linebreak_after_opening_tag' => true,
            'lowercase_cast' => true,
            'mb_str_functions' => false, // have not decided to use this one (yet)
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
            'no_mixed_echo_print' => [
                'use' => 'echo',
            ],
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_multiline_whitespace_before_semicolons' => true,
            'no_php4_constructor' => false, // risky
            'no_short_bool_cast' => true,
            'no_short_echo_tag' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_around_offset' => true,
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unreachable_default_argument_value' => true,
            'no_unused_imports' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_line' => true,
            'normalize_index_brace' => true,
            'not_operator_with_space' => false, // have decided not to use it
            'not_operator_with_successor_space' => false, // have decided not to use it
            'object_operator_without_whitespace' => true,
            'ordered_class_elements' => false, // have decided not to use it, impossible to review in large legacy code base
            'ordered_imports' => true,
            'php_unit_construct' => false, // risky
            'php_unit_dedicate_assert' => false, // risky
            'php_unit_fqcn_annotation' => true,
            'php_unit_strict' => false, // risky
            'phpdoc_add_missing_param_annotation' => [
                'only_untyped' => false,
            ],
            'phpdoc_align' => true,
            'phpdoc_annotation_without_dot' => false, // have not decided to use this one (yet)
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_alias_tag' => [
                'type' => 'var',
            ],
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_order' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => true,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'pow_to_exponentiation' => false, // have not decided to use this one (yet)
            'pre_increment' => true,
            'protected_to_private' => false, // have not decided to use this one (yet)
            'psr0' => false, // using PSR-4
            'psr4' => false, // have not decided to use this one (yet)
            'random_api_migration' => false, // risky
            'return_type_declaration' => true,
            'self_accessor' => false, // it causes an edge case error
            'semicolon_after_instruction' => true,
            'short_scalar_cast' => true,
            'silenced_deprecation_error' => false, // have not decided to use this one (yet)
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
            'unary_operator_spaces' => true,
            'whitespace_after_comma_in_array' => true,
        ];
    }
}

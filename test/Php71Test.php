<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Php71;

final class Php71Test extends AbstractConfigTestCase
{
    protected function createConfig($header = null)
    {
        return new Php71($header);
    }

    protected function name()
    {
        return 'refinery29 (PHP 7.1)';
    }

    protected function rules()
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
            'doctrine_annotation_braces' => true,
            'doctrine_annotation_indentation' => true,
            'doctrine_annotation_spaces' => true,
            'ereg_to_preg' => false, // risky
            'function_to_constant' => true,
            'function_typehint_space' => true,
            'general_phpdoc_annotation_remove' => false, // have not decided to use this one (yet)
            'hash_to_slash_comment' => true,
            'header_comment' => false, // not enabled by default
            'heredoc_to_nowdoc' => false, // have not decided to use this one (yet)
            'include' => true,
            'is_null' => true,
            'linebreak_after_opening_tag' => true,
            'list_syntax' => [
                'syntax' => 'short',
            ],
            'lowercase_cast' => true,
            'mb_str_functions' => false, // have not decided to use this one (yet)
            'magic_constant_casing' => true,
            'method_separation' => true,
            'modernize_types_casting' => true,
            'native_function_casing' => true,
            'native_function_invocation' => true,
            'new_with_braces' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_blank_lines_before_namespace' => false, // conflicts with single_blank_line_before_namespace (which is enabled)
            'no_empty_comment' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_consecutive_blank_lines' => [
                'break',
                'continue',
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'throw',
                'use',
                'useTrait',
            ],
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
            'non_printable_character' => true,
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
            'php_unit_test_class_requires_covers' => false, // have not decided to use this one (yet)
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
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_return_self_reference' => true,
            'phpdoc_order' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_single_line_var_spacing' => true,
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => false, // it reduces usability of @see and @link annotations
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'pow_to_exponentiation' => false, // have not decided to use this one (yet)
            'pre_increment' => true,
            'protected_to_private' => true,
            'psr0' => false, // using PSR-4
            'psr4' => false, // have not decided to use this one (yet)
            'random_api_migration' => false, // risky
            'return_type_declaration' => true,
            'self_accessor' => false, // it causes an edge case error
            'semicolon_after_instruction' => true,
            'short_scalar_cast' => true,
            'silenced_deprecation_error' => false, // have not decided to use this one (yet)
            'simplified_null_return' => false,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'space_after_semicolon' => true,
            'standardize_not_equals' => true,
            'strict_comparison' => false, // risky
            'strict_param' => false, // risky
            'ternary_operator_spaces' => true,
            'ternary_to_null_coalescing' => true,
            'trailing_comma_in_multiline_array' => true,
            'trim_array_spaces' => true,
            'unary_operator_spaces' => true,
            'visibility_required' => [
                'const',
                'property',
                'method',
            ],
            'whitespace_after_comma_in_array' => true,
        ];
    }
}

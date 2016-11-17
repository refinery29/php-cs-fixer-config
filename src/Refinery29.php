<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config;

use PhpCsFixer\Config;

class Refinery29 extends Config
{
    /**
     * @var string
     */
    private $header;

    /**
     * @param string $header
     */
    public function __construct($header = null)
    {
        parent::__construct('refinery29', 'The configuration for Refinery29 PHP applications');

        $this->header = $header;
    }

    public function usingCache()
    {
        return true;
    }

    public function usingLinter()
    {
        return true;
    }

    public function getRiskyAllowed()
    {
        return true;
    }

    public function getRules()
    {
        $rules = [
            '@PSR2' => true,
            'binary_operator_spaces' => true,
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
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_consecutive_blank_lines' => true,
            'no_leading_import_slash' => true,
            'no_leading_namespace_whitespace' => true,
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_short_bool_cast' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_inside_offset' => true,
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
            'phpdoc_summary' => true,
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
            'align_double_arrow' => false,
            'align_equals' => false,
            'combine_consecutive_unsets' => true,
            'concat_with_spaces' => true,
            'dir_constant' => false,
            'echo_to_print' => false,
            'ereg_to_preg' => false,
            'header_comment' => false,
            'linebreak_after_opening_tag' => true,
            'long_array_syntax' => false,
            'modernize_types_casting' => true,
            'no_blank_lines_before_namespace' => false,
            'no_empty_comment' => true,
            'no_multiline_whitespace_before_semicolons' => true,
            'no_php4_constructor' => false,
            'no_short_echo_tag' => true,
            'no_useless_else' => false,
            'no_useless_return' => true,
            'not_operator_with_space' => false,
            'not_operator_with_successor_space' => false,
            'ordered_class_elements' => false,
            'ordered_imports' => true,
            'php_unit_construct' => false,
            'php_unit_dedicate_assert' => false,
            'php_unit_strict' => false,
            'phpdoc_order' => true,
            'phpdoc_property' => false,
            'phpdoc_var_to_type' => false,
            'psr0' => false,
            'random_api_migration' => false,
            'short_array_syntax' => true,
            'strict_comparison' => false,
            'strict_param' => false,
        ];

        if ($this->header !== null) {
            $rules['header_comment'] = [
                'header' => $this->header,
            ];
        }

        return $rules;
    }
}

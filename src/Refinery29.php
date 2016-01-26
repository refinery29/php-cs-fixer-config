<?php

/*
 * Copyright (c) 2016 Refinery29, Inc.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Refinery29\CS\Config;

use Symfony\CS\Config;

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
        return false;
    }

    public function getRules()
    {
        return array_merge(
            $this->getPsr2Rules(),
            $this->getSymfonyRules(),
            $this->getContribRules()
        );
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
        $rules = [
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

        if ($this->header !== null) {
            $rules['header_comment'] = [
                'header' => $this->header,
            ];
        }

        return $rules;
    }
}

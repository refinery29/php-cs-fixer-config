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
            'alias_functions' => true,
            'array_element_no_space_before_comma' => true,
            'array_element_white_space_after_comma' => true,
            'blankline_after_open_tag' => true,
            'concat_without_spaces' => false,
            'double_arrow_multiline_whitespaces' => true,
            'duplicate_semicolon' => true,
            'empty_return' => true,
            'extra_empty_lines' => true,
            'function_typehint_space' => true,
            'include' => true,
            'hash_to_slash_comment' => true,
            'list_commas' => true,
            'method_separation' => true,
            'multiline_array_trailing_comma' => true,
            'namespace_no_leading_whitespace' => true,
            'native_function_casing' => true,
            'new_with_braces' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_empty_lines_after_phpdocs' => true,
            'object_operator' => true,
            'operators_spaces' => true,
            'phpdoc_align' => true,
            'phpdoc_indent' => true,
            'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_type_to_var' => true,
            'phpdoc_var_without_name' => true,
            'pre_increment' => true,
            'remove_leading_slash_use' => true,
            'remove_lines_between_uses' => true,
            'return' => true,
            'self_accessor' => false,
            'short_bool_cast' => true,
            'short_scalar_cast' => true,
            'single_array_no_trailing_comma' => true,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'spaces_after_semicolon' => true,
            'spaces_before_semicolon' => true,
            'spaces_cast' => true,
            'standardize_not_equal' => true,
            'ternary_spaces' => true,
            'trim_array_spaces' => true,
            'unalign_double_arrow' => true,
            'unalign_equals' => true,
            'unary_operators_spaces' => true,
            'unneeded_control_parentheses' => true,
            'unused_use' => true,
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
            'concat_with_spaces' => true,
            'ereg_to_preg' => false,
            'header_comment' => false,
            'logical_not_operators_with_spaces' => false,
            'logical_not_operators_with_successor_space' => false,
            'long_array_syntax' => false,
            'multiline_spaces_before_semicolon' => false,
            'newline_after_open_tag' => true,
            'no_blank_lines_before_namespace' => false,
            'ordered_use' => true,
            'php4_constructor' => false,
            'php_unit_construct' => false,
            'php_unit_strict' => false,
            'phpdoc_order' => true,
            'phpdoc_var_to_type' => false,
            'psr0' => false,
            'short_array_syntax' => true,
            'short_echo_tag' => true,
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

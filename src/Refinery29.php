<?php

namespace Refinery29\CS\Config;

use Symfony\CS\Config\Config;

class Refinery29 extends Config
{
    public function __construct($name = 'refinery29', $description = 'The configuration for Refinery29 PHP applications')
    {
        parent::__construct($name, $description);
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
            'blankline_after_open_tag' => true,
            'concat_without_spaces' => false,
            'double_arrow_multiline_whitespaces' => true,
            'duplicate_semicolon' => true,
            'empty_return' => true,
            'extra_empty_lines' => true,
            'include' => true,
            'list_commas' => true,
            'method_separation' => true,
            'multiline_array_trailing_comma' => true,
            'namespace_no_leading_whitespace' => true,
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
            'phpdoc_short_description' => false,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_type_to_var' => true,
            'phpdoc_var_without_name' => true,
            'pre_increment' => false,
            'remove_leading_slash_use' => true,
            'remove_lines_between_uses' => true,
            'return' => true,
            'self_accessor' => false,
            'single_array_no_trailing_comma' => true,
            'single_blank_line_before_namespace' => true,
            'single_quote' => true,
            'spaces_before_semicolon' => true,
            'spaces_cast' => true,
            'standardize_not_equal' => true,
            'ternary_spaces' => true,
            'trim_array_spaces' => true,
            'unalign_double_arrow' => true,
            'unalign_equals' => true,
            'unused_use' => true,
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
            'concat_with_spaces' => true,
            'ereg_to_preg' => false,
            'function_typehint_space' => true,
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
    }
}

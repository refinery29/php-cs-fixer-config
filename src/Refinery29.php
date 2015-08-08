<?php

namespace Refinery29\CS\Config;

use Symfony\CS\Config\Config;
use Symfony\CS\FixerInterface;

class Refinery29 extends Config
{
    public function __construct($name = 'refinery29', $description = 'The configuration for Refinery29 PHP applications')
    {
        parent::__construct($name, $description);

        $this->fixers = array_merge(
            $this->getEnabledSymfonyFixers(),
            $this->getEnabledContribFixers()
        );
    }

    public function getLevel()
    {
        return FixerInterface::PSR2_LEVEL;
    }

    public function usingCache()
    {
        return true;
    }

    public function usingLinter()
    {
        return true;
    }

    /**
     * @return array
     */
    private function getEnabledSymfonyFixers()
    {
        return [
            'alias_functions',
            'blankline_after_open_tag',
            'double_arrow_multiline_whitespaces',
            'duplicate_semicolon',
            'empty_return',
            'extra_empty_lines',
            'include',
            'join_function',
            'list_commas',
            'multiline_array_trailing_comma',
            'namespace_no_leading_whitespace',
            'new_with_braces',
            'no_blank_lines_after_class_opening',
            'no_empty_lines_after_phpdocs',
            'object_operator',
            'operators_spaces',
            'phpdoc_align',
            'phpdoc_indent',
            'phpdoc_inline_tag',
            'phpdoc_no_access',
            'phpdoc_no_empty_return',
            'phpdoc_no_package',
            'phpdoc_scalar',
            'phpdoc_separation',
            'phpdoc_to_comment',
            'phpdoc_trim',
            'phpdoc_type_to_var',
            'phpdoc_var_without_name',
            'remove_leading_slash_use',
            'remove_lines_between_uses',
            'return',
            'single_array_no_trailing_comma',
            'single_blank_line_before_namespace',
            'single_quote',
            'spaces_before_semicolon',
            'spaces_cast',
            'standardize_not_equal',
            'ternary_spaces',
            'trim_array_spaces',
            'unalign_double_arrow',
            'unused_use',
            'whitespacy_lines',
        ];
    }

    /**
     * @return array
     */
    protected function getEnabledContribFixers()
    {
        return [
            'concat_with_spaces',
            'ordered_use',
            'phpdoc_order',
            'short_array_syntax',
            'short_echo_tag',
        ];
    }
}

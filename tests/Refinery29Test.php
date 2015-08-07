<?php

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Refinery29;
use Symfony\CS\ConfigInterface;
use Symfony\CS\FixerInterface;

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
        $this->assertSame(FixerInterface::PSR2_LEVEL, $config->getLevel());
        $this->assertTrue($config->usingCache());
        $this->assertTrue($config->usingLinter());
    }

    public function testHasEnabledSymfonyFixers()
    {
        $config = new Refinery29();

        $missingFixers = array_diff($this->getEnabledSymfonyFixers(), $config->getFixers());

        $this->assertCount(0, $missingFixers, sprintf(
            'Symfony fixer(s) "%s" should be enabled',
            implode('", "', $missingFixers)
        ));
    }

    public function testHasEnabledContribFixers()
    {
        $config = new Refinery29();

        $missingFixers = array_diff($this->getEnabledContribFixers(), $config->getFixers());

        $this->assertCount(0, $missingFixers, sprintf(
            'Contrib fixer(s) "%s" should be enabled',
            implode('", "', $missingFixers)
        ));
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

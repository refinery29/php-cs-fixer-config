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

    public function testHasNotEnabledExtraFixers()
    {
        $config = new Refinery29();

        $extraFixers = array_diff($config->getFixers(), $this->getEnabledFixers());

        $this->assertCount(0, $extraFixers, sprintf(
            'Fixer(s) "%s" should not be enabled',
            implode('", "', $extraFixers)
        ));
    }

    /**
     * @dataProvider providerDoesNotHaveFixerEnabled
     *
     * @param string $fixer
     * @param string $reason
     */
    public function testDoesNotHaveFixerEnabled($fixer, $reason)
    {
        $config = new Refinery29();

        $this->assertNotContains($fixer, $config->getFixers(), sprintf(
            'Fixer "%s" should not be enabled, because %s',
            $fixer,
            $reason
        ));
    }

    /**
     * @return \Generator
     */
    public function providerDoesNotHaveFixerEnabled()
    {
        $fixers = [
            'align_double_arrow' => 'it conflicts with unalign_double_arrow (which is enabled)',
            'align_equals' => 'it conflicts with unalign_double (yet to be enabled)',
            'concat_without_spaces' => 'it conflicts with concat_with_spaces (which is enabled)',
            'header_comment' => 'we do not have a header we want to add/replace (yet)',
            'ereg_to_preg' => 'it changes behaviour',
            'logical_not_operators_with_spaces' => 'we do not need leading and trailing whitespace before !',
            'logical_not_operators_with_successor_space' => 'we have not decided to use this one (yet)',
            'long_array_syntax' => 'it conflicts with short_array_syntax (which is enabled)',
            'phpdoc_short_description' => 'our short descriptions need some work',
            'php4_constructor' => 'it may change behaviour',
            'php_unit_construct' => 'it may change behaviour',
            'php_unit_strict' => 'it may change behaviour',
            'phpdoc_var_to_type' => 'it conflicts with phpdoc_type_to_var (which is enabled)',
            'pre_increment' => 'it is a micro-optimization',
            'self_accessor' => 'it causes an edge case error',
        ];

        foreach ($fixers as $fixer => $reason) {
            yield [
                $fixer,
                $reason,
            ];
        }
    }

    /**
     * @return array
     */
    private function getEnabledFixers()
    {
        return array_merge(
            $this->getEnabledSymfonyFixers(),
            $this->getEnabledContribFixers()
        );
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
            'method_separation',
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
            'unalign_equals',
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

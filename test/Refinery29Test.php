<?php

namespace Refinery29\CS\Config\Test;

use Refinery29\CS\Config\Refinery29;

class Refinery29Test extends \PHPUnit_Framework_TestCase
{
    public function testImplementsInterface()
    {
        $config = new Refinery29();

        $this->assertInstanceOf('Symfony\CS\ConfigInterface', $config);
    }

    public function testValues()
    {
        $config = new Refinery29();

        $this->assertSame('refinery29', $config->getName());
        $this->assertSame('The configuration for Refinery29 PHP applications', $config->getDescription());
        $this->assertTrue($config->usingCache());
        $this->assertTrue($config->usingLinter());
        $this->assertFalse($config->getRiskyAllowed());
    }

    public function testHasPsr2Rules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getPsr2Rules(),
            $config->getRules(),
            'PSR2'
        );
    }

    public function testHasSymfonyRules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getSymfonyRules(),
            $config->getRules(),
            'Symfony'
        );
    }

    public function testHasContribRules()
    {
        $config = new Refinery29();

        $this->assertHasRules(
            $this->getContribRules(),
            $config->getRules(),
            'Contrib'
        );
    }

    /**
     * @param array  $expected
     * @param array  $actual
     * @param string $set
     */
    private function assertHasRules(array $expected, array $actual, $set)
    {
        foreach ($expected as $fixer => $isEnabled) {
            $this->assertArrayHasKey($fixer, $actual, sprintf(
                'Failed to assert that a rule for fixer "%s" (in set "%s") exists.,',
                $fixer,
                $set
            ));

            $this->assertSame($isEnabled, $actual[$fixer], sprintf(
                'Failed to assert that fixer "%s" (in set "%s") is %s.',
                $fixer,
                $set,
                $isEnabled === true ? 'enabled' : 'disabled'
            ));
        }
    }

    /**
     * @dataProvider providerDoesNotHaveFixerEnabled
     *
     * @param string $fixer
     * @param string $reason
     */
    public function testDoesNotHaveRulesEnabled($fixer, $reason)
    {
        $config = new Refinery29();

        $rule = [
            $fixer => false,
        ];

        $this->assertArraySubset($rule, $config->getRules(), true, sprintf(
            'Fixer "%s" should not be enabled, because "%s"',
            $fixer,
            $reason
        ));
    }

    /**
     * @return array
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

        $data = [];

        foreach ($fixers as $fixer => $reason) {
            $data[] = [
                $fixer,
                $reason,
            ];
        }

        return $data;
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
            'phpdoc_types' => false,
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

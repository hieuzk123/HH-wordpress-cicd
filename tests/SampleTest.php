<?php

class SampleTest
{
    private int $passed = 0;
    private int $failed = 0;

    public function run(): void
    {
        $this->test_sanitize_removes_script_tag();
        $this->test_string_is_not_empty();
        $this->test_addition_is_correct();
        $this->test_array_count();
        $this->printResult();
    }

    private function assert(string $name, bool $condition): void
    {
        if ($condition) {
            echo "[PASS] $name\n";
            $this->passed++;
        } else {
            echo "[FAIL] $name\n";
            $this->failed++;
        }
    }

    private function test_sanitize_removes_script_tag(): void
    {
        $input  = '<script>alert("xss")</script>Hello';
        $output = strip_tags($input);
        $this->assert(
            'Sanitize: strip_tags loại bỏ thẻ script',
            !str_contains($output, '<script>')
        );
    }

    private function test_string_is_not_empty(): void
    {
        $title = 'My WordPress Site';
        $this->assert(
            'String: tiêu đề site không rỗng',
            !empty($title)
        );
    }

    private function test_addition_is_correct(): void
    {
        $this->assert(
            'Math: tính toán đúng',
            (2 + 2) === 4
        );
    }

    private function test_array_count(): void
    {
        $plugins = ['akismet', 'yoast-seo', 'woocommerce'];
        $this->assert(
            'Array: đếm số plugin đúng',
            count($plugins) === 3
        );
    }

    private function printResult(): void
    {
        echo "\n=============================\n";
        echo "Passed: {$this->passed} | Failed: {$this->failed}\n";
        echo "=============================\n";
        if ($this->failed > 0) {
            exit(1);
        }
    }
}

$test = new SampleTest();
$test->run();
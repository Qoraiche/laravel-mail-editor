<?php

namespace Qoraiche\MailEclipse\Utils;

class Replacer
{
    /**
     * Take the format of the Blade syntax and convert to one the editor understands.
     *
     * @param mixed $content
     * @return string|string[]|null
     */
    public function editor($content)
    {
        $patterns = [
            '/@component/i',
            '/@endcomponent/i',
            '/@yield/',
            '/@section/',
            '/@endsection/',
            '/@extends/',
            '/@parent/',
            '/@slot/',
            '/@endslot/',
        ];

        $replacements = [
            '[component]: # ',
            '[endcomponent]: # ',
            '[yield]: # ',
            '[section]: # ',
            '[endsection]: # ',
            '[extends]: # ',
            '[parent]: # ',
            '[slot]: # ',
            '[endslot]: # ',
        ];

        return $this->replace($patterns, $replacements, $content);
    }

    /**
     * Take the data from the editor and return a format that the Blade syntax.
     *
     * @param mixed $content
     * @return void
     */
    public function fromEditor($content)
    {
        $patterns = [
            '/\[component]:\s?#\s?/i',
            '/\[endcomponent]:\s?#\s?/i',
            '/\[yield]:\s?#\s?/i',
            '/\[section]:\s?#\s?/i',
            '/\[endsection]:\s?#\s?/i',
            '/\[extends]:\s?#\s?/i',
            '/\[parent]:\s?#\s?/i',
            '/\[slot]:\s?#\s?/i',
            '/\[endslot]:\s?#\s?/i',
        ];

        $replacements = [
            '@component',
            '@endcomponent',
            '@yield',
            '@section',
            '@endsection',
            '@extends',
            '@parent',
            '@slot',
            '@endslot',
        ];
    }

    /**
     * Replace the content with the patterns and targeted format
     *
     * @param array $patterns
     * @param array $replacements
     * @param mixed $content
     * @return string|string[]|null
     */
    protected function replace(array $patterns, array $replacements, $content)
    {
        return preg_replace($patterns, $replacements, $content);
    }
}

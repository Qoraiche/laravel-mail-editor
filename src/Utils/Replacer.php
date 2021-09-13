<?php

namespace Qoraiche\MailEclipse\Utils;

class Replacer
{
    /**
     * The pattern for the blade syntax to replace.
     *  eg `'/@component/i'`.
     *
     * @var array
     */
    protected $bladeMatchPatterns = [];

    /**
     * The syntax that replaces the blade files.
     * eg `'[component]: # '`.
     *
     * @var array
     */
    protected $bladeReplacePatterns = [];

    /**
     * The patterns of the editor to match.
     * eg `'/\[component]:\s?#\s?/i'`.
     *
     * @var array
     */
    protected $editorMatchPatterns = [];

    /**
     * The blade syntax to change to from the editor.
     * eg `'@component'`.
     *
     * @var array
     */
    protected $editorReplacePatterns = [];

    /**
     * Create a new instance of the replacer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->generateRegex();
    }

    /**
     * Take the format of the Blade syntax and convert to one the editor understands.
     *
     * @param  mixed  $content
     * @return string|string[]|null
     */
    public static function toEditor($content)
    {
        $self = new self();

        return $self->replace($self->bladeMatchPatterns, $self->bladeReplacePatterns, $content);
    }

    /**
     * Take the data from the editor and return a format that the Blade syntax.
     *
     * @param  mixed  $content
     * @return string|string[]|null
     */
    public static function toBlade($content): string
    {
        $self = new self();

        return $self->replace($self->editorMatchPatterns, $self->editorReplacePatterns, $content);
    }

    /**
     * Replace the content with the patterns and targeted format.
     *
     * @param  array  $patterns
     * @param  array  $replacements
     * @param  mixed  $content
     * @return string|string[]|null
     */
    protected function replace(array $patterns, array $replacements, $content)
    {
        return preg_replace($patterns, $replacements, $content);
    }

    /**
     * Generate the regex patterns from a single list.
     *
     * This also ensures that the replace array is the same length as the match array
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function generateRegex()
    {
        $components = config('maileclipse.components');

        $this->bladeMatchPatterns = array_map(function ($component) {
            return "/@${component}/i";
        }, $components);

        $this->bladeReplacePatterns = array_map(function ($component) {
            return "[${component}]: # ";
        }, $components);

        $this->editorMatchPatterns = array_map(function ($component) {
            return "/\[${component}]:\s?#\s?/i";
        }, $components);

        $this->editorReplacePatterns = array_map(function ($component) {
            return "@${component}";
        }, $components);
    }
}

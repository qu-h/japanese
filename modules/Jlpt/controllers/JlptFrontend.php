<?php

class JlptFrontend extends JP_Controller
{
    private $coursePath;

    function __construct()
    {
        parent::__construct();
        $this->coursePath = env('MinaDirectory');
        set_layout('full-content');
    }

    public function grammar($number = 1)
    {
        $filePath = realpath($this->coursePath . "/$number/grammar.md");
        if ($filePath) {
            return $this->showMarkdown($number, 'grammar');
        }
    }

    public function showMarkdown($lesson, $course)
    {
        /*
         * https://github.com/showdownjs/showdown
         * https://markdown-it.github.io/
         */
        $filePath = sprintf("%s/%d/%s.md", $this->coursePath, $lesson, $course);
        $filePath = realpath($filePath);
        if (!$filePath) {
            show_404();
        }

        $grammar = file_get_contents($filePath);

        $Parsedown = new Parsedown();

        $grammar = $Parsedown->text($grammar);
        dd($grammar);
        add_git_assets("showdown.min.js", 'showdown', '1.9.0');
        $pageTitle = sprintf('Bai %d Minna no Nihonggo',$lesson);
        set_temp_val('title',$pageTitle);
        temp_view("Jlpt/$course", compact('grammar'));
    }
}
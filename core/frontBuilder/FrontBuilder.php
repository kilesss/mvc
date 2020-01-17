<?php
namespace frontBuilder;

interface FrontBuilder
{

    public function header();

    public function footer();

    public function cssFiles() : Array;

    public function javascriptFile() : Array;

    public function templateFile();

    public function parameters() : Array;
}
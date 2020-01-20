<?php
namespace frontBuilder;

/**
 * Interface FrontBuilder
 * @package frontBuilder
 */
interface FrontBuilder
{

    /**
     * @return mixed
     */
    public function header();

    /**
     * @return mixed
     */
    public function footer();

    /**
     * @return Array
     */
    public function cssFiles() : Array;

    /**
     * @return Array
     */
    public function javascriptFile() : Array;

    /**
     * @return mixed
     */
    public function templateFile();

    /**
     * @return Array
     */
    public function parameters() : Array;
}
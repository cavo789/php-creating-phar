<?php

namespace Avonture\Classes;

class Glob
{
    /**
     * Constructor
     */
    public function __construct()
    {
        echo 'In the constructor of Glob';
    }

    /**
     * Display the list of files in the current directory
     *
     * @return void
     */
    public function run(): void
    {
        echo "\nList of files\n=============\n\n";

        foreach (glob("*.*") as $filename) {
            echo "* $filename\n";
        }
    }
}

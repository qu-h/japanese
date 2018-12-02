<?php
class ModuleHook {
    function loadModule(){
        die("call me");
        Modules::run('layouts');
    }
}
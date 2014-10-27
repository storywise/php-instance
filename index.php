<!DOCTYPE html>
<html>
        <head>
                <title></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <style>
                        body, div, span {
                                font-family:'Helvetica', 'Arial', _sans;
                                font-size:13px;
                        }
                        pre { 
                                font-family:'courier new', 'courier','mono'; 
                                font-size:12px;
                        }
                        pre {
                                background:#EEE;
                                padding:4px 8px;
                                border:1px #CCC solid;
                        }
                        body > div {
                                width:750px;
                                padding:15px;
                        }
                        body > div > .tip {
                                margin:10px 0px;
                                background-color:#FADAAA;
                                padding:5px 10px;
                                border:1px #999 solid;
                        }
                        body > div > .tip span {
                                font-family:'Courier New', 'Courier', 'mono';
                                font-size:12px;
                        }
                </style>
        </head>
        <body>
                <div>
                        <h1>Abstract class 'Instance' for rapid factory building blocks with MVC adaptation</h1>

                        <h2>Introduction</h2>
                        Extending your class with 'Instance', allows you to automatically adapt it to different application states in a factory based setup. The instance generator scans the availability of a class matching a set of abstract and type arguments. You could say it is querying for the existence of  a class definition in a chain of criteria, untill it finds the first match. If available it automatically detects a model and view, and composes the mvc instance prior to returning it.

                        <h2>Instance arguments</h2>
                        Through this customized pattern, an instance is requested through a defined static get method. For example:
                        <pre>$instance = Example::get();</pre>

                        The method definition could look something like this:
                        <pre>public static function get() {
        $instance = Instance::create( 
                array('example'), 
                array('affordable'), 
                Instance::$SINGLETON, Instance::$AUTH 
        );
        return $instance;
}</pre>

                        <h2>Instance::create parameters</h2>
                        The first parameter is an array that defines the abstract types. Since its an array its possible to define several types as the abstract. Passing in array('example', 'shape') for exampe, will assume <i>ExampleShape</i> as the bottom level abstract class of this implementation.
                        <div class="tip">If you wish to enforce a true abstract behavior, pass in this configuration <span>Instance::$NOABSTRACT</span> property, to prevent the abstract class from being instantiated.</div>
                        The second parameter is an array that defines the implementation types. Where the abstract type holds functionality which is inherited by all, the implementations can override it, or extend upon it to adapt to a specific application state/case. When passing in array('page', 'home') as the second argument for example, the instance generator will run through <i>ExampleShape</i> as the bottom level abstract class of this implementation.
                        <div class="tip">If you wish to enforce a true abstract behavior, pass in this configuration <span>Instance::$NOABSTRACT</span> property, to prevent the abstract class from being instantiated.</div>

                        <h2>Instance::create configurations</h2>
                        <b>Instance::$NOVIEW</b>
                        Instance configuration preventing a view from being created

                        <b>Instance::$NOMODEL</b>
                        Instance configuration preventing a model from being created

                        <b>Instance::$NOCHAIN</b>
                        Instance configuration forcing

                        <b>Instance::$SINGLETON</b>
                        Instance configuration forcing the object to only be constructed once

                        <b>Instance::$AUTH</b>
                        Instance configuration scanning for available user authority types

                        <b>Instance::$NOABSTRACT</b>
                        Instance configuration allowing only to create a subtype of the abstract definition


                        <?php
                        // Boot up the framework autoloader
                        require_once "php/boot.php";

                        // Apply some dummy auth types of logged in users that may see different types
                        Instance::setAuthTypes(array('Admin', 'Customer'));
                        // Create bottom level Example and output
                        $example = Example::get();

                        if ($example !== false) {
                                $example->setContext('Instance of most lower level');
                                $example->output();
                        }

                        // Create implementation of the bottom level called luxury
                        $example2 = Example::get2('luxury');
                        if ($example2 !== false) {
                                $example2->setContext('Instance of luxury implementation upon lower level, custom implementation of model and controller only');
                                $example2->output();
                        }

                        // Create implementation of the bottom level called luxury
                        $example3 = Example::get2('affordable');
                        if ($example3 !== false) {
                                $example3->setContext('Instance of affordable implemention upon lower level, custom implementation of model and view only.');
                                $example3->output();
                        }

                        // Create implementation of a singelton example
                        $example4 = Example::get3();
                        if ($example4 !== false) {
                                $example4->setContext('Singelton instance of lower level with scanning of auth types.');
                                $example4->output();

                                $noconstructormsg = Example::get3();
                        }
                        ?>
                </div>
        </body>
</html>
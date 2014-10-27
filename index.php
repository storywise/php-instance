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
                        <?php
                        
                        // Boot up the framework autoloader
                        require_once "php/boot.php";

                        // Allow for informative messages throughout all instances
                        Instance::setDebugging();
                        
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

                                // This retrieval wont execute the constructor again, because its configured to be a singleton
                                $noconstructormsg = Example::get3();
                        }
                        
                        ?>
                </div>
        </body>
</html>
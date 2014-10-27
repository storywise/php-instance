# PHP-Instance and it's Autoload
Abstract class 'Instance' for rapid factory building blocks with MVC adaptation

## 'Autoload' introduction
The autoload functionality provided, utilizes the camelcase classname with matching filename to enforce a hierarchical folder structure. For example the class `ExamplePageHome` is expected to be located in *php/framework/*`example/page/home/ExamplePageHome.php`. This is particularly handy to group classes that are spawned through the *PHP-Instance* tool, with or without model/view. It's pretty easy, you'll soon enough.

## 'Instance' introduction
Extending your class with 'Instance', allows you to automatically adapt it to different application states in a factory based setup. The instance generator scans the availability of a class matching a set of abstract and type arguments. You could say it is querying for the existence of a class definition in a chain of criteria, untill it finds the first match. If available it automatically detects a model and view, and composes the mvc instances prior to returning the controller.

Instance arguments

A PHP-Instance is requested through a defined static get method. For example:
```php
$instance = Example::get();
```

A method definition could look something like this:
```php
class Example extends Instance {

        /**
        * Receiving an instance of Example does not occur through $var = new Example();
        * But through $var = Example::get();
        */
        public static function get() {
                $instance = Instance::create( 
                        array('example'), 
                        array('affordable'), 
                        Instance::$SINGLETON, // Pass in as many configurations after the second argument
                        Instance::$AUTH 
                );
                return $instance;
        }
        
        /**
        * If the programmer desires so, a matching model and/or view can be defined for 
        * the implemenation of Example. The constructor of an 'Instance' always accepts a model and view argument.
        */
        public function __construct( InstanceModel $model = null, InstanceView $view = null ) {
                parent::__construct( $model, $view );
        }
}
```

## Instance::create arguments

The first parameter is an array that defines the abstract types. Since its an array its possible to define several types as the abstract. Passing in `array('example', 'shape')` for example, will assume `ExampleShape` as the bottom level abstract class of this implementation. If you wish to enforce a true abstract behavior, pass in this configuration `Instance::$NOABSTRACT` property, to prevent the abstract class from being instantiated.

The second parameter is an array that defines the implementation types. Where the abstract type holds functionality which is inherited by all, the implementations can override it, or extend upon it to adapt to a specific application state/case. When passing in `array('page', 'home')` as the second argument for example, the instance generator will start to check if a class exists called `ExampleShapePageHome`, if it doesn't match then it checks `ExampleShapePage`, finally if that wasn't defined then it will return the Abstract definition unless `$NOABSTRACT` was configured. If nothing is found, false is returned. 

Instance::$NOVIEW Instance configuration preventing a view from being created Instance::$NOMODEL Instance configuration preventing a model from being created Instance::$NOCHAIN Instance configuration forcing Instance::$SINGLETON Instance configuration forcing the object to only be constructed once Instance::$AUTH Instance configuration scanning for available user authority types Instance::$NOABSTRACT Instance configuration allowing only to create a subtype of the abstract definition
Instance is scanning the existence of these classes in order of appearance, and will return first class found:

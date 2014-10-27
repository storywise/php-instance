PHP-Instance
========
Extending your class with 'Instance', allows you to automatically adapt it to different application states in a factory based setup. The instance generator scans the availability of a class matching a set of abstract and type arguments. You could say it is querying for the existence of a class definition in a chain of criteria, untill it finds the first match. If available it automatically detects a model and view, and composes the mvc instance prior to returning it.

### Work in progress.

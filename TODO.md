Single Responsibility Principle
===============================

# Violations
* The class has many instance variables
* The class has many public methods
* Each method of the class uses other instance variables
* Specific tasks are delegated to private methods 

# TODO
* Extract the methods from Helpling\SystemService to proper classes in Helpling\Solid\\* namespace.

# Hints
* The DIC configuration is changed and the application works with empty classes. Once you finish the task application should be running.
* Remember to pass the PDO connection.
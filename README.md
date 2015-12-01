# helpling-solid
Example code for the SOLID principles workshop

# How to start
Clone the repository and start provided virtual machine.
```
git checkout 0_start
vagrant up
vagrant ssh
cd /vagrant/
composer install
sqlite3 app/data/helpling.db < app/data/1_init.sql
php app/console.php helpling:hello
```

Learn SOLID by doing. Refactor given code by applying SOLID principles. 

# SOLID principles
## Single Responsiblity Principle
A class should have one, and only one, reason to change

### Violations
* The class has many instance variables
* The class has many public methods
* Each method of the class uses other instance variables
* Specific tasks are delegated to private methods 

### Excercises, branch: 1_srp
* Split the almighty SystemService according to the Single Responsibility Principle

## Open/closed Principle
You should be able to extend a class’s behavior, without modifying it.

### Violations
* The class has conditions to determine a strategy.
* Conditions using the same variables or constants are recurring inside the class or related classes.
* It contains hard-coded references to other classes or class names. 
* Inside the class objects are being created using the new operator.
* Specific tasks are delegated to private methods 

### Excercises, branch: 2_ocp
* Introduce the open/closed principle (get rid of switch) use the Strategy design pattern.
* Implement GenerateStrategyInterface for once, weekly and biweekly order type
* Configure the OrderTypeStrategyResolver

## Liskov Substitution Principle	
Derived classes must be substitutable for their base classes. 

### Violations
* Doesn’t provide an implementation for all the methods of the base class.
* Doesn’t return the type of things the base class prescribes.
* Puts extra constraints on arguments for methods.
* Makes use of non-strict typing to break the contract that was provided by the base class.

### Excercises, branch: 3_lsp
* Generate jobs for DEO200 and list them.
* Fix the problem related to wrong count value

## Interface Segregation Principle
Make fine-grained interfaces that are client specific.
### Violations
* multiple use cases (a lot of public methods)
* clients are forced to depend on methods they do not use

### Excercises, branch: 4_isp
* Split the JobRepositoryInterface to FindJobsByOrderInterface and PersistJobInterface.
* Fix the FilePersistJob and ExportService to relay on newly created interfaces


## Dependency Inversion Principle
Depend on abstractions, not on concretions.

### Violations
* abstractions are depending on details (implementations not on interfaces)
* a high-level class depends upon a low-level class
* a class depends upon a class from another package

### Excercises, branch: 5_dip
* Change the DEAULT_JOB_REPOSITORY to mongoJobRepository
* Fix the JobListCommand and the GenerateService to be able to use Mongo and Sqlite.

# Used technologies
* symfony/console - console application framework
* pimple/pimple - simple di container
* pdo to access sqlite
* mongo + php driver

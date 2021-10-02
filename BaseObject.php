BaseObject is the base class that implements the property feature.
BaseObject это базовый класс, реализующий функцию свойства.

A property is defined by a getter method (e.g. getLabel), and/or a setter method (e.g. setLabel). For example, the following getter and setter methods define a property named label:
Свойство определяется методом getter (равносильно getLabel) и/или методом setter (равносильно setLabel). Например, следующие методы getter и setter определяют свойство label:

private $_label;

public function getLabel()
{
    return $this->_label;
}

public function setLabel($value)
{
    $this->_label = $value;
}

Property names are case-insensitive.
Названия свойств указываются без учета регистра.

A property can be accessed like a member variable of an object. Reading or writing a property will cause the invocation of the corresponding getter or setter method. For example,
Свойство может быть доступно как изменяемый элемент объекта. Чтение или запись свойства вызовет соответствующий метод getter или setter. Например,

// equivalent to $label = $object->getLabel();
$label = $object->label;
// equivalent to $object->setLabel('abc');
$object->label = 'abc';
If a property has only a getter method and has no setter method, it is considered as read-only. In this case, trying to modify the property value will cause an exception.
Если свойство имеет только метод getter, то он считается доступным только для чтения. В данном случае при попытке изменить значение свойства - будет вызвано исключение.

One can call hasProperty(), canGetProperty() and/or canSetProperty() to check the existence of a property.
Можно вызывать методы hasProperty(), canGetProperty() и/или canSetProperty() чтобы проверить существование, возможность получения и/или установки свойства.

Besides the property feature, BaseObject also introduces an important object initialization life cycle. In particular, creating an new instance of BaseObject or its derived class will involve the following life cycles sequentially:
Кроме функции свойства BaseObject также необходим для инициализации объекта. Фактически при создании нового экземпляра BaseObject или унаследованного класса будет выполнена следующая последовательность:

the class constructor is invoked;
вызывается класс конструктора;
object properties are initialized according to the given configuration;
свойства объекта инициализируются согласно полученной конфигурации;
the init() method is invoked.
вызывается метод init().
In the above, both Step 2 and 3 occur at the end of the class constructor. It is recommended that you perform object initialization in the init() method because at that stage, the object configuration is already applied.
Выше шаги 2 и 3 осуществляются в конце конструктора класса. Рекомендуется чтобы инициализация объекта выполнялась в методе init() потому что на этом шаге конфигурация объекта уже применена.

In order to ensure the above life cycles, if a child class of BaseObject needs to override the constructor, it should be done like the following:
Чтобы класс BaseObject правильно работал, в случае если конструктор наследника класса BaseObject необходимо переопределить, вы должны выполнить следующее:

public function __construct($param1, $param2, ..., $config = [])
{
    ...
    parent::__construct($config);
}
That is, a $config parameter (defaults to []) should be declared as the last parameter of the constructor, and the parent implementation should be called at the end of the constructor.
Параметр $config (по умолчанию []) должен быть определен как последний параметр в конструкторе, и выполнение родительского класса должно вызываться в конце конструктора.

Public Methods
Открытые методы

Method	Description	Defined By
Метод Описание Определен в
__call()	Calls the named method which is not a class method.	yii\base\BaseObject
__construct()	Constructor.	yii\base\BaseObject
__get()	Returns the value of an object property.	yii\base\BaseObject
__isset()	Checks if a property is set, i.e. defined and not null.	yii\base\BaseObject
__set()	Sets value of an object property.	yii\base\BaseObject
__unset()	Sets an object property to null.	yii\base\BaseObject
canGetProperty()	Returns a value indicating whether a property can be read.	yii\base\BaseObject
canSetProperty()	Returns a value indicating whether a property can be set.	yii\base\BaseObject
className()	Returns the fully qualified name of this class.	yii\base\BaseObject
hasMethod()	Returns a value indicating whether a method is defined.	yii\base\BaseObject
hasProperty()	Returns a value indicating whether a property is defined.	yii\base\BaseObject
init()	Initializes the object.	yii\base\BaseObject
Method Details
__call() public method
Calls the named method which is not a class method.

Do not call this method directly as it is a PHP magic method that will be implicitly called when an unknown method is being invoked.
public mixed __call ( $name, $params )
$name	string	
The method name
$params	array	
Method parameters
return	mixed	
The method return value
throws	yii\base\UnknownMethodException	
when calling unknown method
__construct() public method
Constructor.

The default implementation does two things:

Initializes the object with the given configuration $config.
Call init().
If this method is overridden in a child class, it is recommended that

the last parameter of the constructor is a configuration array, like $config here.
call the parent implementation at the end of the constructor.
public void __construct ( $config = [] )
$config	array	
Name-value pairs that will be used to initialize the object properties
__get() public method
Returns the value of an object property.

Do not call this method directly as it is a PHP magic method that will be implicitly called when executing $value = $object->property;.

See also __set().
public mixed __get ( $name )
$name	string	
The property name
return	mixed	
The property value
throws	yii\base\UnknownPropertyException	
if the property is not defined
throws	yii\base\InvalidCallException	
if the property is write-only
__isset() public method
Checks if a property is set, i.e. defined and not null.

Do not call this method directly as it is a PHP magic method that will be implicitly called when executing isset($object->property).

Note that if the property is not defined, false will be returned.

See also https://secure.php.net/manual/en/function.isset.php.
public boolean __isset ( $name )
$name	string	
The property name or the event name
return	boolean	
Whether the named property is set (not null).
__set() public method
Sets value of an object property.

Do not call this method directly as it is a PHP magic method that will be implicitly called when executing $object->property = $value;.

See also __get().
public void __set ( $name, $value )
$name	string	
The property name or the event name
$value	mixed	
The property value
throws	yii\base\UnknownPropertyException	
if the property is not defined
throws	yii\base\InvalidCallException	
if the property is read-only
__unset() public method
Sets an object property to null.

Do not call this method directly as it is a PHP magic method that will be implicitly called when executing unset($object->property).

Note that if the property is not defined, this method will do nothing. If the property is read-only, it will throw an exception.

See also https://secure.php.net/manual/en/function.unset.php.
public void __unset ( $name )
$name	string	
The property name
throws	yii\base\InvalidCallException	
if the property is read only.
canGetProperty() public method
Returns a value indicating whether a property can be read.

A property is readable if:

the class has a getter method associated with the specified name (in this case, property name is case-insensitive);
the class has a member variable with the specified name (when $checkVars is true);
See also canSetProperty().
public boolean canGetProperty ( $name, $checkVars = true )
$name	string	
The property name
$checkVars	boolean	
Whether to treat member variables as properties
return	boolean	
Whether the property can be read
canSetProperty() public method
Returns a value indicating whether a property can be set.

A property is writable if:

the class has a setter method associated with the specified name (in this case, property name is case-insensitive);
the class has a member variable with the specified name (when $checkVars is true);
See also canGetProperty().
public boolean canSetProperty ( $name, $checkVars = true )
$name	string	
The property name
$checkVars	boolean	
Whether to treat member variables as properties
return	boolean	
Whether the property can be written
className() public static method
Deprecated since 2.0.14. On PHP >=5.5, use ::class instead.
Returns the fully qualified name of this class.
public static string className ( )
return	string	
The fully qualified name of this class.
hasMethod() public method
Returns a value indicating whether a method is defined.

The default implementation is a call to php function method_exists(). You may override this method when you implemented the php magic method __call().
public boolean hasMethod ( $name )
$name	string	
The method name
return	boolean	
Whether the method is defined
hasProperty() public method
Returns a value indicating whether a property is defined.

A property is defined if:

the class has a getter or setter method associated with the specified name (in this case, property name is case-insensitive);
the class has a member variable with the specified name (when $checkVars is true);
See also:

canGetProperty()
canSetProperty()
public boolean hasProperty ( $name, $checkVars = true )
$name	string	
The property name
$checkVars	boolean	
Whether to treat member variables as properties
return	boolean	
Whether the property is defined
init() public method
Initializes the object.

This method is invoked at the end of the constructor after the object is initialized with the given configuration.
public void init ( )

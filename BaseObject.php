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

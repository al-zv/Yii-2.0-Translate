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

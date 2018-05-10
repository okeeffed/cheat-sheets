# Swift 3 OOP

<!-- TOC -->

*   [Swift 3 OOP](#swift-3-oop)
    *   [Structs](#structs)
    *   [Instances of Objects](#instances-of-objects)
    *   [Methods](#methods)
    *   [Initialisers and Self](#initialisers-and-self)
    *   [Class](#class)
    *   [Inheritance](#inheritance)
    *   [Structs vs Classes](#structs-vs-classes)
        *   [---- Value type vs Reference type](#-----value-type-vs-reference-type)

<!-- /TOC -->

---

## Structs

```
let coordinate1: (x: Int, y: Int) = (1,0) //tuple
coordinate1.x

// structs are the blueprints
struct Point {
  let x: Int
  let y: Int
}

// when defining structs, define the params
let p1 = Point(x: 1, y: 0)
p1
```

---

## Instances of Objects

```
// when defining structs, define the params
let p1 = Point(x: 1, y: 0)
p1
p1.x
p1.y

struct User {
  let username: String
  let password: String
}

let Login = User(username: "example@mail.com", password: "123pass")
Login.username
Login.password
```

<div id="newSection"></div>

---

## Methods

*   Declaring empty arrays that infer a type `var results: [Point] = []`
*   Declaring it the preferred way `var results = [Point]()`

```
struct PointTwo {
  let x: Int
  let y: Int

  // three slashes helps with definitions

  /// Returns the surrounding points in range of
  /// the current one
  func points(inRange range: Int = 1) -> [PointTwo] {
    var results = [PointTwo]()

    let lowerBoundOfXRange = x - range
    let upperBoundOfXRange = x + range

    let lowerBoundOfYRange = y - range
    let upperBoundOfYRange = y + range

    for xCoordinate in lowerBoundOfXRange...upperBoundOfXRange {
      for yCoordinate in lowerBoundOfYRange...upperBoundOfYRange {
        let coordinatePoint = PointTwo(x: xCoordinate, y: yCoordinate)
        results.append(coordinatePoint)
      }
    }

    return results
  }
}

let p2 = PointTwo(x: 1, y: 0)
p2.x
p2.y

let rangeReturn = p2.points(inRange: 3)
rangeReturn[0].x
rangeReturn[3].y

struct Person {
    let firstName: String
    let lastName: String

    func fullName() -> String {
      return firstName + " " + lastName
    }
}

let aPerson = Person(firstName: "Billy", lastName: "Bob")
let myFullName = aPerson.fullName()
```

---

## Initialisers and Self

Self is generally only used in Swift in the init method or when differentiating

```
struct Point {
  let x: Int
  let y: Int

  init(x: Int, y: Int) {
    self.x = x;
    self.y = x;
  }
}

struct RGBColor {
  let red: Double
  let green: Double
  let blue: Double
  let alpha: Double

  let description: String

  // Add your code below
  init(red: Double, green: Double, blue: Double, alpha: Double) {
    self.red = red
    self.green = green
    self.blue = blue
    self.alpha = alpha

    self.description = "red: \(self.red), green: \(self.green), blue: \(self.blue), alpha: \(self.alpha)"
  }
}

let test = RGBColor(red: 16.0, green: 5.0, blue: 4.3, alpha: 3.0)
test.description
```

<div id="classes"></div>

---

## Class

```swift
class Enemy {
  var life: Int = 2
  let position: Point

  init(x: Int, y: Int) {
    self.position = Point(x: x, y: y)
  }

  func decreaseLife(by factor: Int) {
    life -= factor
  }

}

struct Location {
  let latitude: Double
  let longitude: Double
}

class Business {
  var name: String
  var location: Location

  init(name: String, location: Location) {
    self.name = name
    self.location = location
  }
}

let someBusiness = Business(name: "Quiry", location: Location(latitude: 341, longitude: 82))
```

<div id="inheritance"></div>

---

## Inheritance

```
class SuperEnemy: Enemy {
  let isSuper: Bool = true

  override init(x: Int, y: Int) {
    super.init(x: x, y: y)
    self.life = 50
  }
}
```

```
class Vehicle {
  var numberOfDoors: Int
  var numberOfWheels: Int

  init(withDoors doors: Int, andWheels wheels: Int) {
      self.numberOfDoors = doors
      self.numberOfWheels = wheels
  }
}

class Car: Vehicle {
  var numberOfSeats: Int = 4

  override init(withDoors doors: Int, andWheels wheels: Int) {
    super.init(withDoors: doors, andWheels: wheels)
  }

}

let someCar = Car(withDoors: 4, andWheels: 4)
```

```
class Person {
  let firstName: String
  let lastName: String

  init(firstName: String, lastName: String) {
    self.firstName = firstName
    self.lastName = lastName
  }

  func fullName() -> String {
    return "\(firstName) \(lastName)"
  }
}

// Enter your code below
class Doctor: Person {

  override init(firstName: String, lastName: String) {
    super.init(firstName: firstName, lastName: lastName)
  }

  override func fullName() -> String {
    return "Dr. \(lastName)"
  }
}

let someDoctor = Doctor(firstName: "Sam", lastName: "Smith")
```

<div id="final"></div>

---

## Structs vs Classes

Distinct line in the sand.

```swift
import UIKit

var str = "Hello, playground"


struct User {
  var fullName: String
  var email: String
  var age: Int
}

var someUser = User(fullName: "Denis O'Keeffe", email: "test@test", age: 24)

var anotherUser = someUser

someUser.email = "newemail@email"

// remains as test@test
anotherUser.email

class Person {
  var fullName: String
  var email: String
  var age: Int

  init(name: String, email: String, age: Int) {
    self.fullName = name
    self.email = email
    self.age = age
  }
}

var somePerson = Person(name: "Tim Cook", email: "tc@apple.com", age: 54)

var anotherPerson = somePerson

somePerson.email = "newemail@email"

// newemail@email -> points to the same reference
anotherPerson.email
```

<div id="valuevsref"></div>

### ---- Value type vs Reference type

Values are copied across, references are not. All `structs` are value types.

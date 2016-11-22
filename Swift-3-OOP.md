# Swift 3 OOP

***

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

***

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

***

## Methods

- Declaring empty arrays that infer a type `var results: [Point] = []`
- Declaring it the preferred way `var results = [Point]()`

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

***

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



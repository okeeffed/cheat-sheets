# Swift 3 Extensions

<!-- TOC -->

*   [Swift 3 Extensions](#swift-3-extensions)
    *   [Extensions](#extensions)
        *   [---- Computed Properties](#-----computed-properties)
        *   [---- Mutating Instance Methods](#-----mutating-instance-methods)
        *   [---- Subscripts](#-----subscripts)
        *   [---- Nested Types](#-----nested-types)

<!-- /TOC -->

---

## Extensions

Extensions add new functionality to an existing class, structure, enumeration, or protocol type.

This includes the ability to extend types for which you do not have access to the original source code (known as retroactive modeling). Extensions are similar to categories in Objective-C. (Unlike Objective-C categories, Swift extensions do not have names.)

Extensions in Swift can:

*   Add computed instance properties and computed type properties
*   Define instance methods and type methods
*   Provide new initializers
*   Define subscripts
*   Define and use new nested types
*   Make an existing type conform to a protocol

```
extension SomeType: SomeProtocol, AnotherProtocol {
    // implementation of protocol requirements goes here
}
```

<div id="computed"></div>

### ---- Computed Properties

```
struct Size {
    var width = 0.0, height = 0.0
}
struct Point {
    var x = 0.0, y = 0.0
}
struct Rect {
    var origin = Point()
    var size = Size()
}

let defaultRect = Rect()
let memberwiseRect = Rect(origin: Point(x: 2.0, y: 2.0), size: Size(width: 5.0, height: 5.0))

extension Rect {
    init(center: Point, size: Size) {
        let originX = center.x - (size.width / 2)
        let originY = center.y - (size.height / 2)
        self.init(origin: Point(x: originX, y: originY), size: size)
    }
}

let centerRect = Rect(center: Point(x: 4.0, y: 4.0),
                      size: Size(width: 3.0, height: 3.0))
// centerRect's origin is (2.5, 2.5) and its size is (3.0, 3.0)
```

Extensions can add new instance methods and type methods to existing types. The following example adds a new instance method called repetitions to the Int type:

```
extension Int {
    func repetitions(task: () -> Void) {
        for _ in 0..<self {
            task()
        }
    }
}

3.repetitions {
    print("Hello!")
}
// Hello!
// Hello!
// Hello!
```

<div id="mutating"></div>

### ---- Mutating Instance Methods

```
extension Int {
    mutating func square() {
        self = self * self
    }
}
var someInt = 3
someInt.square()
// someInt is now 9
```

### ---- Subscripts

Extensions can add new subscripts to an existing type. This example adds an integer subscript to Swift’s built-in Int type. This subscript [n] returns the decimal digit n places in from the right of the number:

```
123456789[0] returns 9
123456789[1] returns 8
```

```
extension Int {
    subscript(digitIndex: Int) -> Int {
        var decimalBase = 1
        for _ in 0..<digitIndex {
            decimalBase *= 10
        }
        return (self / decimalBase) % 10
    }
}
746381295[0]
// returns 5
746381295[1]
// returns 9
746381295[2]
// returns 2
746381295[8]
// returns 7

746381295[9]
// returns 0, as if you had requested:
0746381295[9]
```

### ---- Nested Types

Extensions can add new nested types to existing classes, structures, and enumerations:

```
extension Int {
    enum Kind {
        case negative, zero, positive
    }
    var kind: Kind {
        switch self {
        case 0:
            return .zero
        case let x where x > 0:
            return .positive
        default:
            return .negative
        }
    }
}

// The nested enumeration can now be used with any Int value:

func printIntegerKinds(_ numbers: [Int]) {
    for number in numbers {
        switch number.kind {
        case .negative:
            print("- ", terminator: "")
        case .zero:
            print("0 ", terminator: "")
        case .positive:
            print("+ ", terminator: "")
        }
    }
    print("")
}
printIntegerKinds([3, 19, -27, 0, -6, 0, 7])
// Prints "+ + - 0 - 0 + "
```

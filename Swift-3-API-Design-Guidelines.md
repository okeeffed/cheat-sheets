# API Design Guidelines in Swift 3

## SWD-1: Why do we need guidelines?

Initially when Swift was created, there were no real guidelines.

It still largely means working with Objective-C code.

With the open sourcing in 2015, the Swift team worked towards a standard for the guidelines.

The most important rule with Swift is to correctly use the `Point of Use`. Readability at call site is more important than point of definition.

Methods and properties are written once and called and used many times, so the focus should be on the latter.

Secondly, `Clarity Over Brevity`. It is a non goal to enable to smallest possible code. With Objective-C, it was important to write with clarity for naming conventions. We want to stay on board with this clarity for naming.

## SWD-2: Guidelines for Naming Types

High level goal of naming things according to their role.

Example for a quick variable:

```
var someValue = 12	// bad choice
var counter = 12	// better choice
```

*Rules for Naming*

Names of types properties, variables and constants should _read as nouns_.

Example `class NetworkResponse` - we know from the name that it is for a `NetworkReponse`. Therefore, we would decide that the responsibility for Network Connection is the responsibility for another class.

An example from the _Swift Standard Library Names_ is `BidirectionalCollection` - we know from the name that it is a collection that deals with both forward and backward traversal. `Sequence` protocol describes a type that provides sequential access to its elements.

The exceptions to this rule is for `Boolean` values - they should read as asserts. Eg. `isEmpty`.

The second excepetion is the -able, -ible or -ing suffixes - used for protocols that model capabilities. Examples of this are `Equatable` to distinguish between the same type, with other examples such as `Comparable` and `ExpressibleByStringLiteral`.

## SWD-3: Guidelines for Naming Methods

We consider function names to be the base name plus the function list. Therefore, reading it will mean that it requires the base name and the arguments in order to understand it.

For the function parameters themselves, they have both a external name and a local name.

`func index(_ i: Self.Index, offsetBy n: Self.IndexDistance) -> Self.Index`

In the second parametere, `offsetBy` is the external name.

If there is just one parameter, then that will be both the external and local name. You can use `_` to offset the parameter external name.

*Rule 1*
We should always check how functions read and use sites when we write them.

Example: `func insert(_ e: Element, atPosition: Int)` is better than `insert(element: "a", position: 1)`.

*Rule 2*
Avoid Ambiguity

`func remove(atIndex: Int).` over `func remove(_ index: Int)`

However, in the case of ambiguous type information, we preceed each weakly typed parameter with a noun describing it's role.

`func addObserver(_ observer: AnyObject)` over `func add(observer: AnyObject)`

`func update(value: Any, key: String)`

Here, Any and String both have weak type information.

`func updateValue(_ value: Any, forKey key: String)`

*Summary*

- Omit needless information
- Include all words need to avoid ambiguity
- Compensate for weak type information

## SWD-4: Fluent Usage

The high level guidelines don't give too many details. 

*Fluent Usage*

Methods and functions should be read as grammatical English phrases at the use site.

Example: `func find(character: String, range: Range<String.Index>) -> Int`

This function takes as an argument a character which we'll define as a string defined. We also need the range, so we'll give it range.

We could use...

`func find(character: String, in range: Range<String.Index>) -> Int`

But since it is ambiguous for weak type information, would be to omit the external label and the first argument of the name describing it's role:

`func find(character: Character, in range: Range<String.Index>) -> Int`

## SWD-5: Prepositional vs Grammatical Phrases

This is an exception for the grammatical phrases.

Eg. "The laptop on the desk" - `on` is the preposition.

How does this relate?

Eg.

`func move(position: Int)`

Normally we would say "move to position", however if we need to use that preposition `to` then we give it an argument label that begins at the preposition.

`func move(toPosition position: Int)`

Another example would be `x.removeBoxes(havingLength: 12)`.

The exception to this would be that only one argument governed the function. 

Example, `func move(toX: Int, y: Int)`

We begin with the prepositional phrase, however both args are part of the abstraction. In that case, we move the preposition out of the arguments in to the base name.

`func moveTo(x: Int, y: Int)`

Another example for context:

`func dismiss(animated: Bool)`





















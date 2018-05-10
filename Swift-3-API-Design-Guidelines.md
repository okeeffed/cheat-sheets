# API Design Guidelines in Swift 3

<!-- TOC -->

*   [API Design Guidelines in Swift 3](#api-design-guidelines-in-swift-3)
    *   [SWD-1: Why do we need guidelines?](#swd-1-why-do-we-need-guidelines)
    *   [SWD-2: Guidelines for Naming Types](#swd-2-guidelines-for-naming-types)
    *   [SWD-3: Guidelines for Naming Methods](#swd-3-guidelines-for-naming-methods)
    *   [SWD-4: Fluent Usage](#swd-4-fluent-usage)
    *   [SWD-5: Prepositional vs Grammatical Phrases](#swd-5-prepositional-vs-grammatical-phrases)
    *   [SWD-6: Recap on Naming](#swd-6-recap-on-naming)
    *   [SWD-7: Side-Effects and Mutation](#swd-7-side-effects-and-mutation)
    *   [SWD-8: Conventions](#swd-8-conventions)

<!-- /TOC -->

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

_Rules for Naming_

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

_Rule 1_
We should always check how functions read and use sites when we write them.

Example: `func insert(_ e: Element, atPosition: Int)` is better than `insert(element: "a", position: 1)`.

_Rule 2_
Avoid Ambiguity

`func remove(atIndex: Int).` over `func remove(_ index: Int)`

However, in the case of ambiguous type information, we preceed each weakly typed parameter with a noun describing it's role.

`func addObserver(_ observer: AnyObject)` over `func add(observer: AnyObject)`

`func update(value: Any, key: String)`

Here, Any and String both have weak type information.

`func updateValue(_ value: Any, forKey key: String)`

_Summary_

*   Omit needless information
*   Include all words need to avoid ambiguity
*   Compensate for weak type information

## SWD-4: Fluent Usage

The high level guidelines don't give too many details.

_Fluent Usage_

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

## SWD-6: Recap on Naming

_Prepositional Phrase: Exception_

`view.fadeTo(red: a, green: b, blue: c)`

_Grammatical Phrase_

`view.addSubview(y)`

_Neither Gammatical Nor Prepositional_

`func dismiss(animated: Bool)`

*   Omit needless words
*   Avoid ambiguity
*   Avoid needless words

_More Examples of Methods from the Swift SDK_

```
func activate(_ constraints: [NSLayoutConstraint])
// activate constraints - grammatical
// omit needless words - so no need for activateConstraints
```

```
func max(_ x: Int, _ y: Int) -> Int
// no meaningful to write more beyond the base
// no need for naming arguments
```

## SWD-7: Side-Effects and Mutation

We want to name methods in accordance with their side effect.

This is one that mutates the current state. If it effects the current state, it should be named using verb phrases.

An example would adding an element to the array. This effects the state of the array as it mutates it.

`func append(_ newElement: Element)`

Nouns are used for when the state is not effected.

`func distance(to point: Point)`

What if the operation is naturally described as a verb?

Then we use the imperitive form for the verb.

`anArray.filter(isEven)` - filter being the verb mutating the array state.

_Mutating verse non-mutation of the state_

Mutating example: `anArray.sort()`
Non-mutating example: `let sortedArray = anArray.sorted()`

Suffixes that can be used include `-ed` and when it doesn't sound right `-ing`.

_Mutation for nouns_

This is simpler. We use noun for non-mutating and form prefix for mutating counterpart.

Mutating example: `anArray.formUnion(with: anotherArray)`
Non-mutating: `let union = anArray.union(with: anotherArray)`

The exception arises for pairs of mutating and non-mutating counterparts.

If it best described using a verb, you use that for the mutating method.

For non-mutating, use `-ed` or `-ing` suffix.

Then noun form for non-mutating version of nouns and form prefix for mutating method.

## SWD-8: Conventions

_Boolean Methods_

`func isInRange(of point: Point)`

_Parameters_

*   Choose parameter names that serve documentation.
*   Use default values where possible to simplify function signatures.
*   In Swift, default args are preferred to method families.

```
let order = lastName.compare(royalFamilyName, options: [], range: nil, local: nil)
```

Keep parameters with default parameters to sit at the end of the function.

Same basenames are also fine if they operate within different domains.

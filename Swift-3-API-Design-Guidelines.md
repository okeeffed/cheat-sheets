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
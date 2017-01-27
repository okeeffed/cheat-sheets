# API Design Guidelines in Swift 3

## SWD-1: Why do we need guidelines?

Initially when Swift was created, there were no real guidelines.

It still largely means working with Objective-C code.

With the open sourcing in 2015, the Swift team worked towards a standard for the guidelines.

The most important rule with Swift is to correctly use the `Point of Use`. Readability at call site is more important than point of definition.

Methods and properties are written once and called and used many times, so the focus should be on the latter.

Secondly, `Clarity Over Brevity`. It is a non goal to enable to smallest possible code. With Objective-C, it was important to write with clarity for naming conventions. We want to stay on board with this clarity for naming.

## SWD-2: Naming Types


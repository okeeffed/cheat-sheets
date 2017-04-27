# Intro to Scala

Builds on top of the JVC. Scala also does things like treating functions as first class citizens. You define functions without names and as closures.

The adoption of Scala use it for a variety of projects.

Apache Spark is also written in Scala.

There are two ways to create variables: `val` (constant) and `var` (mutable).

```scala
scala> val greeting = "Hello World!"
greeting: String = Hello World!

scala> greeting = "Allo"
<console>:12: error: reassignment to val
       greeting = "Allo"
                ^

scala> var mes = "Hello!"
mes: String = Hello!

scala> mes
res0: String = Hello!

scala> mes = "Hello World!"
mes: String = Hello World!

scala> mes
res1: String = Hello World!
```

We can always provide type information or the semi-colon if we wanted to, although not recommended (interesting they would say this...).
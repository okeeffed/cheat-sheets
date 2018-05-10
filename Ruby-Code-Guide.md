# Ruby Basics Help Sheet

<!-- TOC -->

*   [Ruby Basics Help Sheet](#ruby-basics-help-sheet)
    *   [RUBY-1: Comments](#ruby-1-comments)
*   [This is an example comment](#this-is-an-example-comment)
    *   [RUBY-2: Variables](#ruby-2-variables)
    *   [RUBY-3: Console puts](#ruby-3-console-puts)
    *   [RUBY-4: Call a method](#ruby-4-call-a-method)
    *   [RUBY-5: Define a method](#ruby-5-define-a-method)
    *   [RUBY-6: Equality](#ruby-6-equality)
    *   [RUBY-7: Inequality](#ruby-7-inequality)
    *   [RUBY-8: Decisions with if](#ruby-8-decisions-with-if)
    *   [RUBY-9: Constants](#ruby-9-constants)
    *   [RUBY-10: Strings](#ruby-10-strings)
    *   [RUBY-11: Concatentation](#ruby-11-concatentation)
    *   [RUBY-12: Substitute](#ruby-12-substitute)
    *   [RUBY-13: String Access](#ruby-13-string-access)
    *   [RUBY-14: Arrays](#ruby-14-arrays)
    *   [RUBY-15: add an array element](#ruby-15-add-an-array-element)
    *   [RUBY-16: Hashes](#ruby-16-hashes)
    *   [THRUBY-1: TH Ruby Basics](#thruby-1-th-ruby-basics)
    *   [THRUBY-2: Ruby Strings](#thruby-2-ruby-strings)
    *   [THRUBY-2: Ruby Numbers](#thruby-2-ruby-numbers)
    *   [THRUBY-2: Ruby Methods](#thruby-2-ruby-methods)

<!-- /TOC -->

## RUBY-1: Comments

# This is an example comment

## RUBY-2: Variables

```ruby
variable = some_value

name = "Tobi"
name # => "Tobi"

sum = 18 + 5
sum # => 23
```

## RUBY-3: Console puts

```ruby
puts something

puts "Hello World"
puts [1, 5, "mooo"]
```

## RUBY-4: Call a method

```ruby
object.method(args)

string.length
array.delete_at(2)
string.gsub("ae", "ä")
```

## RUBY-5: Define a method

```ruby
def name(parameter)
	#method body
end

def greet(name)
	puts "Hi there " + name
end
```

## RUBY-6: Equality

```ruby
object == other

true == true # => true
3 == 4 # => false
"Hello" == "Hello" # => true
```

## RUBY-7: Inequality

```ruby
object != other

true != true # => false
3 != 4 # => true
```

## RUBY-8: Decisions with if

```ruby
if condition
	# happens when true
else
	# happens when false
end

if input == password
	grant_access
else
	deny_access
end
```

## RUBY-9: Constants

```ruby
CONSTANT = some_value

PI = 3.1415926535
```

## RUBY-10: Strings

```ruby
'This is a string'
'This is a string with an #{expression}'

example = 'This is another string'
example.length
```

## RUBY-11: Concatentation

```ruby
string + string2
"Hello " + "reader"
```

## RUBY-12: Substitute

```ruby
string.gsub(a_string, substitute)
"Bill".gsub("ill", "oo")
# => "Boo"
```

## RUBY-13: String Access

```ruby
string[position] "Hello"[1] # => "e"
```

## RUBY-14: Arrays

```ruby
[contents]

[]	# empty array
["Rails", "fun", 5]

array.size

[].size # => 0
[1,2,3].size # => 3
["foo", "bar"].size # => 2

array[position]
```

## RUBY-15: add an array element

```ruby
array << element

array = [1,2,3]
array << 4
array # => [1,2,3,4]
array[4] = 5

array.delete_at(i)

array.each do |e| .. end

persons.each do |p|
	puts p.name
end

numbers.each do |n|
	n = n * 2
end
```

## RUBY-16: Hashes

Hashes associate a key to some value. You may then retrieve the value based upon its key. This construct is called a dictionary in other languages, which is appropriate because you use the key to "look up" a value, as you would look up a definition for a word in a dictionary. Each key must be unique for a given hash but values can be repeated.

Hashes can map from anything to anything! You can map from Strings to Numbers, Strings to Strings, Numbers to Booleans... and you can mix all of those! Although it is common that at least all the keys are of the same class. Symbols are especially common as keys. Symbols look like this: :symbol. A symbol is a colon followed by some characters. You can think of them as special strings that stand for (symbolize) something! We often use symbols because Ruby runs faster when we use symbols instead of strings.

```ruby
{key => value}
{:hobby => 'programming'}

{42 => 'answer', 'score' => 100, :name => 'Tobi'}

hash[key]

hash = {:key => 'value'}
hash[:key] # =>  'value'
hash[foo] # => nil

hash[key] = value

hash = {:a => "b"}
hash[:key] = "value"
hash # => {:a=>b, :key=>"value"}

hash.delete(key)
hash = {:a => 'b', :b => 10}
hash.delete(:a)
hash # => {:b=>10}
```

---

## THRUBY-1: TH Ruby Basics

Interactive environment: irb (in the terminal)

```ruby
puts "hello world!"
```

**Mathematics**

```ruby
3**2 // this means three to the square of two
Math.sqrt(a+b)	// this is a static method
```

**Methods**

```ruby
def hi
	puts "Hello World!"
end
```

*   if the method does not take parameters, then you do not need to define the curly braces

**Classes**

```ruby
class Greeter
	attr_accessor :name
	def initialize(name = "World")
		@name = name
	end
	def say_hi
		puts "Hi #{@name}!"
	end
	def say_bye
		puts "Bye #{@name}, come back"
	end
end

greeter = Greeter.new("Pat")
```

*   Using attr_accessor defined two new methods for us, name to get the value, and name= to set it.

**LOOPING**

```ruby
@names.each do |name|
  puts "Hello #{name}!"
end

# Say bye to everybody
def say_bye
  if @names.nil?
    puts "..."
  elsif @names.respond_to?("join")
    # Join the list elements with commas
    puts "Goodbye #{@names.join(", ")}.  Come back soon!"
  else
    puts "Goodbye #{@names}.  Come back soon!"
  end
end
```

**Input and Output**

Giving input to the variable.

*   puts auto creates \n
*   print does not

```ruby
# name = "Jason"

print "Please enter your name: "
name = gets # this is what is going to take the input
puts "Hello #{name}!"
```

---

## THRUBY-2: Ruby Strings

**What are Strings?**

*   Using double quotes when creating a string will cause variables in the string to be interpolated.

```ruby
# this will all print out as is
name="Dennis"
string = <<-STRING
Hello
My name is #{name}
Workspaces is fun!
STRING
thisAlsoWorks="This is
a multiline String
"
```

**Whitespace**

\n -> new line
\s -> space
\t -> new tab

```ruby
example = "New line \nhere"
```

---

## THRUBY-2: Ruby Numbers

---

## THRUBY-2: Ruby Methods

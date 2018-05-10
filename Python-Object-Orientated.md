# Python Object Orientated

<!-- TOC -->

*   [Python Object Orientated](#python-object-orientated)
    *   [Table of Contents](#table-of-contents)
    *   [Objects](#objects)
        *   [---- Creating Instances](#-----creating-instances)
        *   [---- Class Methods](#-----class-methods)
        *   [---- \_ _ init _ \_](#-----_-_-init-_-_)
    *   [Python Inheritance](#python-inheritance)
        *   [---- Python Subclassing](#-----python-subclassing)
        *   [---- \_ _ str _ \_](#-----_-_-str-_-_)
        *   [---- Instance Methods](#-----instance-methods)
        *   [---- Overriding Inheritance](#-----overriding-inheritance)

<!-- /TOC -->

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="section"></div>

---

## Objects

<div id="objects1"></div>

### ---- Creating Instances

```
>>> class Monster:
...     hit_points=1
...     color="blue"
...     weapon="sword"
...
>>> monster = Monster()
>>> monster.hit_points
1
>>> monster.weapon
'sword'
>>> monster.color
'blue'

# jubjub instance
>>> jubjub = Monster()
>>> type(jubjub)
<type 'instance'>
>>> jubjub.hit_points
1
>>> jubjub.hit_points = 5
>>> jubjub.hit_points
5
```

<div id="objects2"></div>

### ---- Class Methods

```
>>> class Methods:
...     a = 2
...     sound="roar"
...     def battlecry(self):
...             return self.sound.upper()
...
>>> general = Methods()
>>> general.battlecry()
'ROAR'
```

Code Challenge

```
class Store:
    open = 9
    close = 18

    def hours(self):
        return "We're open from {} to {}".format(self.open, self.close)
```

<div id="objects3"></div>

### ---- \_ _ init _ \_

Dealing with the dunder init!

```
class Monster:
	def __init__(self, **kwargs):
		self.hit_points = kwargs.get('hit_points', 5)
		self.weapon = kwargs.get('weapon', 'sword')
		self.color = kwargs.get('color', 'yellow')
		self.sound = kwargs.get('sound', 'yell')

monster = Monster(hit_points=22, color="green")
```

<div id="inheritance"></div>

---

## Python Inheritance

Building on from before, we're just making some defaults...

```
class Monster:
	min_hp = 1
	max_hp = 1
	min_exp = 1
	max_exp = 1
	weapon = 'sword'
	sound = 'roar'

	def __init__(self, **kwargs):
		self.hp = random.randint(self.min_hp, self.max_hp)
		self.exp = random.randint(self.min_exp, self.max_exp)
		self.color = random.choice(COLORS)

		for key, value in kwargs.items():
			setattr(self, key, value)

	def battlecry(self):
		return self.sound.upper()

new_mon = Monster()
new_mon.hp
# 1
new_mon.color
# 'blue'

fresh = Monster(color='blue', sound='whistling', hp='500', adjective='manxsome')
fresh.color
# 'blue'
fresh.adjective
# manxsome
```

<div id="inheritance2"></div>

### ---- Python Subclassing

```
# building on from monster

class Goblin(Monster):
	max_hp = 3
	max_exp = 2
	sound = 'squek'

golbin = Goblin()
goblin.hp
# 2 - now isn't just 1 from the min/max set above!
goblin.color
# 'blue'

class Troll(Monster):
	min_hp = 3
	max_hp = 5
	min_exp = 2
	max_exp = 6
	sound = 'growl'
```

Challenge

Create a new class named Dragon that extends the Monster class. Don't forget to import Monster from monster. Give your Dragon an integer size attribute.

```
from monster import Monster

class Dragon(Monster):
    size = 12
```

<div id="inheritance3"></div>

### ---- \_ _ str _ \_

This helps us when we print(object)

```
class Monster:
	...
	def __str__(self):
		return '{} {}, HP: {} ...'.format(self.color.title(), self.__class__.__name__, self.hp, self.exp)
	...

draco = Monster()
print(draco)
# returns the details from the magic method
```

Challenge

Import Game from game. Make a new class named GameScore that extends Game. Use pass if needed.

Add a **str** method to GameScore that returns the score in the string "Player 1: 5; Player 2: 10", using the correct values from self.score. self.score is a tuple with Player 1's score and Player 2's score like (5, 10).
You do not need to define self.score. It comes from the Game class.

```
from game import Game

class GameScore(Game):
    pass

    def __str__(self):
        return "Player 1: {}; Player 2: {}".format(*self.score)
```

<div id="inheritance4"></div>

### ---- Instance Methods

```
class Character:
	exp = 0
	hp = 10

	def __init__(self, **kwargs):
		self.name = input("Name: ")
		self.weapon = self.get_weapon()
		for k, v in kwargs.items():
			setattr(self, k, v)

	def get_weapon(self):
		weapon_choice = input("Weapon: [S]word, [A]xe: ").lower()

		if weapon_choice in 'sa':
			if weapon_choice == 's':
				return 'sword'
			else
				return 'axe'
```

Challenge

Add a score method to Game that takes a player argument. The player argument will be either 1 or 2. Increase that player's value in self.current_score by 1. You'll need to adjust the index (i.e. player = 1 means self.current_score[0] needs to increase).

```
class Game:
  def __init__(self):
    self.current_score = [0, 0]

  def score(self, player):
    if player in [1,2]:
        if player == 1:
            self.current_score[0] += 1
        elif player == 2:
            self.current_score[1] += 1
        return
```

<div id="inheritance5"></div>

### ---- Overriding Inheritance

```
class Character(Combat):
	attack_limit = 10

	# pretend that we're overriding the Combat attack method)
	def attack(self):
		roll = random.randint(1, self.attack_limit)
		if self.weapon == 'sword':
			roll += 1
		elif self.weapon == 'axe':
			roll +=2
		return roll > 4
```

Code Challenge

Animal.noise() returns self.sound.lower(). Make Sheep.noise() return the uppercased version of the instance's sound.

```
from animal import Animal

class Sheep(Animal):
    sound = "Bless"

    def noise(self):
        return self.sound.upper()
```

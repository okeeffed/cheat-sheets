//
//
// 	  Treehouse PHP Classes
//
//

> PHP OOP
	> classes
		> recipe.php
		> cookbook.php

// recipe.php

<?php

class Recipe
{
	private $title;
	public $ingredients = array();
	public $instruction = array();
	public $yield;
	public $tag = array();
	public $source = 'Alena Holligan';

	private $measurements = array(
		"tsp",
		"tbsp",
		"cup",
		"oz",
		"lb",
		"fl oz",
		"pint",
		"quart",
		"gallon"
	);

	public function displayRecipe()
	{
		return $this->title . "by" . $this->source;
	}

	public function addIngredient($item, $amount = null, $measure=null)
	{
		if ($amount != null && !is_float($amount) && !is_int($amount)) {
			exit("The amount must be a float: ") . gettype($amount) . " $amount given");
		}

		if ($measure != null && !in_array(strtolower($measure), $this->measurements)) {
			exit("Please enter a valid measurement: " . implode(", ", $this->measurements));
		}

		$this->ingredients[] = array (
			"item" => ucwords($item),
			"amount" => $amount,
			"measure" => strtolower($measure)
		);
	}

	public function getIngredients()
	{
		return $this->ingredients;
	}

	public function setTitle($title)
	{
		$this->title = ucword($title);
	}

	public function getTitle()
	{
		return $this->title;
	}

}

?>

// cookbook.php

<?php

include "classes/recipes.php";

$recipe1 = new Recipe();
echo $recipe1->source;
$recipe1->source("Grandma Holligan");
echo $recipe1->source;
$recipe1->setTitle("My first recipe");
$recipe1->getTitle();

$recipe1->addIngredient("egg",1);
$recipe1->addIngredient("flour",2,"cup");

$recipe2 = new Recipe();
$recipe2->source = "Betty Crocker";
$recipe1->setTitle = "My second recipe";

echo $recipe1->source;
echo $recipe2->source;

echo $recipe1->displayRecipe();
echo $recipe2->displayRecipe();

foreach ($recipe1->getIngredients() as $ing) {
	echo "\n" . $ing["amount"] . " " . $ing["measure"] . " " . $ing["item"];
}

var_dump($recipe1);

?>

//
//
// 	  PHP Access Modifiers
//
//

<?php

class Render {

  public static function displayDimensions($size) {
      return $size[0] . " x " . $size[1];
  }

  public static function detailsKitchen($room) {
       return "Kitchen Dimensions: " . self::displayDimensions($room->getDimensions());
  }

}

?>

//
//
// 	  PHP MAGIC METHODS AND CONSTANTS
//
//

Some magic constants:

__CLASS__
__FILE__
<?php
class Example
{

	public function __construct($title = null)
	{
		$this->setTitle($title);
	}

	public function __toString()
	{
		$output = "You are calling a " . __CLASS__ . " object with the title \"";
		$output .= $this->getTitle() . "\"";
		$output .= "\nIt is stored in " . basename(__FILE__) . " at " . __DIR__ . ".";
		$output .= "\nThis display is from line " . __LINE__ . " in method " . __METHOD__;
		$output .= "\nThe following methods are available for objects of this class: \n";
		$output .= implode("\n", get_class_methods(__CLASS__));
		return $output;
	}
}

class Render
{

	public function __toString()
	{
		$output = "The following methods are available for " . __CLASS__ . " objects: \n";
		$output .= implode("\n", get_class_methods(__CLASS__));
		return $output;
	}
}

$example = new Example("Name");
echo $example;

?>

<?php

class Fish
{
    public $common_name;
    public $flavor;
    public $record_weight;

    public function __construct($name, $flavor, $record) {
      $this->common_name = $name;
      $this->flavor = $flavor;
      $this->record_weight = $record;
    }

    public function getInfo() {
      return "A {$this->common_name} is an {$this->flavor} flavored fish. The world record weight is {$this->record_weight}.";
    }
}

$bass = new Fish("Largemouth Bass", "Excellent", "22 pounds 5 ounces");

?>

//
//
// 	  PHP Collections
//
//

recipecollection.php

<?

class RecipeCollection
{
	private $title;
	private $recipes = array();

	// has constructor here and setter and getters

	public function addRecipe($recipe) {
		$this->recipes[] = $recipe;
	}

	public function getRecipe() {
		return $this->recipes;
	}
}

?>

//
//
// 	  PHP Arrays
//
//

Create
$myArray = array();

Push into
$myArray[] = "­Som­eth­ing­";

Push to associ­ative
$myArr­ay[­'key'] = "­Val­ue";

Create numeric
$myArray = array(­'va­lue', 'value2');

Create associ­ative
$a = array(­'ke­y'=­>'v­al');

Print from numeric
echo $myArr­ay[0];

Print from associ­ative
echo $myArr­ay[­'key'];

Associ­ative arrays
Keys are strings

Numeric arrays
Keys are numbers: 0,1,2,3,4

//
//
// 	  PHP Array Functions
//
//

array_diff (arr1, arr2 ...)
array_filter (arr, function)
array_flip (arr)
array_intersect (arr1, arr2 ...)
array_merge (arr1, arr2 ...)
array_pop (arr)
array_push (arr, var1, var2 ...)
array_reverse (arr)
array_keys(array $array [, mixed $search_value = null [, bool $strict = false ]] )
array_search (needle, arr)
array_walk (arr, function)
count (count)
in_array (needle, haystack)

// ARRAY EXAMPLES

<?php
	// add code below this comment
class Subdivision
{
  public $houses = array();

  public function filterHouseColor($color)
  {
    $return = array();
    foreach ($this->houses as $house) {
      if ($house->roof_color == $color || $house->wall_color == $color) {
        $return[] = $house;
      }
    }
    return $return;
  }
}

?>

<? php

public function getCombinedIngredients()
{
	$ingredients = array();
	foreach ($this->recipes as $recipe) {
		foreach($recipe->getIngredients() as $ing) {
			$item = $ing["item"];

			if (strpos($item, ",")) {
				$item = strstr($item, ",", true);
			}

			if (in_array($item."s", $ingredients)) {
				$item.="s";
			} else if (in_array(substr($item, 0, -1), $ingredients)) {
				$item = substr($item, 0, -1);
			}

			$ingredients[$item] = array (
				$ing["amount"],
				$ing["measure"]
			);
		}
	}

	return $ingredients;
}

?>

//
//
// 	  PHP Control Flow Logic
//
//

if (condi­tion) {
... }
elseif (condi­tion) {
... }
else {
... }

FOR loop
for (initi­alize; condition; update) { ... }

WHILE loop
while (condi­tion) { ... }

FOREACH loop
foreach ($array as $value) { ... }

DO WHILE
do { ... ;} while (condi­tion)

SWITCH ($s) {
case 1:
...
break;
case 2:
...
break;
default:
...
}

//
//
// 	  PHP if/elseif statements within a web document
//
//

<?php

$bool = false;

?>

<?php if ($bool) : ?>

	<div>
		<p><?php echo "Bool is true"?></p>
	</div>

<?php elseif (!$bool) : ?>

	<div>
		<p><?php echo "Elseif works"?></p>
	</div>

<?php else : ?>

	<div>
		<p><?php echo "Bool is false"?></p>
	</div>

<?php endif; ?>

//
//
// 	  PHP General Functions
//
//

isset()
test for variable exists
empty()
test for empty variable
mail($to, $subject, $msg, 'From: ' . $email)
mail function
mysqli­_fe­tch­_ar­ray­($r­esult)
fetch each row of a query (in $result)
header()
send a header from the server
is_num­eric()
test to see if a value is number
exit()
causes script to stop immedi­ately
trim($­string)
trims leading and trailing spaces
mysqli­_re­al_­esc­ape­_st­rin­g($­string)
escapes special characters
str_re­pla­ce('a', 'b', $string)
replace a with b in a string
explode(', ' , $string)
make string into array
implode(', " $string)
make array into string
substr ($string, start, len)
grabs a substring
preg_m­atc­h('­regex', $string)
matches regular expres­sions
preg_r­epl­ace­('r­egex', $replace, $string)
replaces characters in a string by regex

//
//
// 	  PHP Regex Functions
//
//

ereg (pattern, str)
split (pattern, str)
ereg_replace (pattern, replace, str)
preg_grep (pattern, arr)
preg_match (pattern, str)
preg_match_all (pattern, str, arr)
preg_replace (pattern, replace, str)
preg_split (pattern, str)

//
//
// 	  PHP String Functions
//
//

crypt (str, salt)
explode (sep, str)
implode (glue, arr)
nl2br (str)
sprintf (frmt, args)
strip_tags (str, allowed_tags)
str_replace (search, replace, str)
strpos (str, needle)
strrev (str)
strstr (str, needle)
strtolower (str)
strtoupper (str)
substr (string, start, len)

//
//
// 	  PHP File System Functions
//
//

clearstatcache ()
copy (source, dest)
fclose (handle)
fgets (handle, len)
file (file)
filemtime (file)
filesize (file)
file_exists (file)
fopen (file, mode)
fread (handle, len)
fwrite (handle, str)
readfile (file)clearstatcache ()
copy (source, dest)
fclose (handle)
fgets (handle, len)
file (file)
filemtime (file)
filesize (file)
file_exists (file)
fopen (file, mode)
fread (handle, len)
fwrite (handle, str)
readfile (file)

//
//
// 	  PHP Date/Time Functions
//
//

checkdate (month, day, year)
date (format, timestamp)
getdate (timestamp)
mktime (hr, min, sec, month, day, yr)
strftime (formatstring, timestamp)
strtotime (str)
time ()

//
//
// 	  PHP Date Formatting
//
//

Y
4 digit year (2008)
y
2 digit year (08)
F
Long month (January)
M
Short month (Jan)
m
Month ⁴ (01 to 12)
n
Month (1 to 12)
D
Short day name (Mon)
l
Long day name (Monday) (lowercase L)
d
Day ⁴ (01 to 31)
j
Day (1 to 31)

h
12 Hour ⁴ (01 to 12)
g
12 Hour (1 to 12)
H
24 Hour ⁴ (00 to 23)
G
24 Hour (0 to 23)
i
Minutes ⁴ (00 to 59)
s
Seconds ⁴ (00 to 59)

w
Day of week ¹ (0 to 6)
z
Day of year (0 to 365)
W
Week of year ² (1 to 53)
t
Days in month (28 to 31)

a
am or pm
A
AM or PM
B
Swatch Internet Time (000 to 999)
S
Ordinal Suffix (st, nd, rd, th)

T
Timezone of machine (GMT)
Z
Timezone offset (seconds)
O
GMT offset (hours) (+0200)
I
Daylight saving (1 or 0)
L
Leap year (1 or 0)

U
Seconds since Epoch ³
c
ISO 8601 (PHP 5) (2008-­07-­31T­18:­30:­13+­01:00)
r
RFC 2822 (Thu, 31 Jul 2008 18:30:13 +0100)


## Accessing deep arrays to find values 

```php
$locations = Timber::get_terms('locations');

		$data = [];
		$exclusion = [];

		foreach($locations as $location) {
			$data[] = [
				"location" => $location,
				"posts" => Locations::getPostsForLocation($location,$count,$exclusion)
			];

			// add posts with current ids to array to check against
			foreach ($data as $key => $value) {
				if ($value["posts"]) {
					$posts = $value["posts"];
					foreach($posts as $key => $value) {
						if (in_array($value->id, $exclusion)) {
							unset($posts[$key]);
						} else {
							array_push($exclusion, $value->id);
						}
					}
				}
			}
		}
```

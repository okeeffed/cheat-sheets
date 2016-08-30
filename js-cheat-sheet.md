# JavaScript Cheat Sheet

## JAVASCRIPT DOC READY

```javascript
$(document).ready(function () {
  futureRoaming.init();
});
```

## JAVSCRIPT BASIC OBJECT

```javascript
var person = {
    firstName:"John",
    lastName:"Doe",
    age:50,
    eyeColor:"blue"
};
```

## AJAX

```html
// example one

<!DOCTYPE html>
<html>
<body>

<div id="demo"><h2>Let AJAX change this text</h2></div>

<button type="button" onclick="loadDoc()">Change Content</button>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}
</script>

</body>
</html>

// example database

<!DOCTYPE html>
<html>
<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>
<body>

<form action="">
<select name="customers" onchange="showCustomer(this.value)">
<option value="">Select a customer:</option>
<option value="ALFKI">Alfreds Futterkiste</option>
<option value="NORTS ">North/South</option>
<option value="WOLZA">Wolski Zajazd</option>
</select>
</form>
<br>
<div id="txtHint">Customer info will be listed here...</div>

<script>
function showCustomer(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("txtHint").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "getcustomer.asp?q="+str, true);
  xhttp.send();
}
</script>

</body>
</html>
```

## LOCAL STORAGE

```javascript
localStorage.getItem();
localStorage.setItem();
localStorage.removeItem();
```

## JAVASCRIPT PROMISES

Updating an AJAX call to use promises

```javascript
// BEFORE ADDING THE PROMISE

var xhr = new XMLHttpRequest();
xhr.open('GET', '../data/employees.json');
xhr.onreadystatechange = handleResponse;
xhr.send();

function handleResponse() {
  if(xhr.readyState === 4 && xhr.status === 200) {
    var employees = JSON.parse(xhr.responseText);
    addEmployeesToPage(employees)
  }
};

function generatListItems(employees)  {
    var statusHTML = '';
    for (var i=0; i<employees.length; i += 1) {
        if (employees[i].inoffice === true) {
            statusHTML += '<li class="in">';
        } else {
            statusHTML += '<li class="out">';
        }
        statusHTML += employees[i].name;
        statusHTML += '</li>';
    }

    return statusHTML;
}

function generateUnorderedList(listItems) {
    return '<ul class="bulleted">' + listItems +  '</ul>';
}

function addEmployeesToPage(employees) {
    document.getElementById('employeeList').innerHTML = generateUnorderedList(generatListItems(employees));
}

// AFTER ADDING THE PROMISE

function generatListItems(employees)  {
    var statusHTML = '';
    for (var i=0; i<employees.length; i += 1) {
        if (employees[i].inoffice === true) {
            statusHTML += '<li class="in">';
        } else {
            statusHTML += '<li class="out">';
        }
        statusHTML += employees[i].name;
        statusHTML += '</li>';
    }

    return statusHTML;
}

function generateUnorderedList(listItems) {
    return '<ul class="bulleted">' + listItems +  '</ul>';
}

function addEmployeesToPage(ul) {
    document.getElementById('employeeList').innerHTML = ul;
}

function getJSON(url) {
        return new Promise(function(resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url);
            xhr.onreadystatechange = handleResponse;
            xhr.onerror = function(error) { reject(error); };
            xhr.send();

            function handleResponse() {
                if(this.readyState === this.DONE)
                    if(this.status === 200) {
                        resolve(JSON.parse(this.responseText));
                    } else {
                        reject(this.statusText);
                    }
            }
        });
}


var p = getJSON('../data/employees.json').then(generatListItems)
                                         .then(generateUnorderedList)
                                         .then(addEmployeesToPage).catch(function(e){
                                            console.log(e);
                                         });
```

## JAVASCRIPT OBJECT BEFORE ES6

```javascript
var futureRoaming = {
  themeUrl: $('meta[name=theme_url]').attr('content'),

  init: function () {
    $.ajax({
      url: futureRoaming.themeUrl + '/feature-modules/future-roaming-map/data/data.json',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        futureRoaming.createDomElement();
        futureRoaming.data = data;
        futureRoaming.loadMap();
        futureRoaming.handleForm();
        futureRoaming.handleChange();
      }
    });
  },

  setDropdownStyling: function(component, divId) {
      if (component.localeCompare("Select") != 0) {
        $(divId).css('opacity', '1');
        $(divId).css('text-decoration', 'none');
      } else {
        console.log("Arrived");
        $(divId).css('opacity', '0.8');
        $(divId).css('text-decoration', 'underline');
      }
  },

  handleChange: function() {
    futureRoaming.$form.change(function() {
      var year = $(this).find('#future-roaming-module-year').val();
      var age = $(this).find('#future-roaming-module-age').val();
      var season = $(this).find('#future-roaming-module-season').val();
      var reason = $(this).find('#future-roaming-module-reason').val();

      futureRoaming.setDropdownStyling(year, "#future-roaming-module-year");
      futureRoaming.setDropdownStyling(age, "#future-roaming-module-age");
      futureRoaming.setDropdownStyling(season, "#future-roaming-module-season");
      futureRoaming.setDropdownStyling(reason, "#future-roaming-module-reason");

      if (year.localeCompare("Select") != 0 && age.localeCompare("Select") != 0 && season.localeCompare("Select") != 0 && reason.localeCompare("Select") != 0) {
        futureRoaming.showResult(year,age,season,reason);
      } else {
        console.log("Not there");
      }

    });
  },

  handleForm: function () {
    futureRoaming.$form.submit(function (e) {
      e.preventDefault();
      var year = $(this).find('#future-roaming-module-year').val();
      var age = $(this).find('#future-roaming-module-age').val();
      var season = $(this).find('#future-roaming-module-season').val();
      var reason = $(this).find('#future-roaming-module-reason').val();

      futureRoaming.showResult(year,age,season,reason);

      return false;
    });
  },

  showResult: function(year,age,season,reason) {
    var result = futureRoaming.data[year][age][season][reason];

    // Update map
    if(futureRoaming.$mapCurrent) {
      futureRoaming.$mapCurrent.attr('class','jvectormap-region jvectormap-element');
    }
    if(result.country.code) {
      futureRoaming.$mapCurrent = futureRoaming.$map.find('path[data-code="' + result.country.code + '"]');
      futureRoaming.$mapCurrent.attr('class', 'jvectormap-region jvectormap-element active');
      futureRoaming.vectorMap.setFocus({
        region: result.country.code,
        animate: true
      });
    }

    // Update copy
    futureRoaming.$country.text(result.country.name);
    futureRoaming.$text.text(result.text);
  },

  loadMap: function () {
    $(futureRoaming.$map[0]).vectorMap({
      map: 'world_mill',
      zoomOnScroll: false
    });
    futureRoaming.vectorMap = futureRoaming.$map.vectorMap('get', 'mapObject');
  },

  createDomElement: function () {
    futureRoaming.$elem = $('<div/>').addClass('future-roaming-module').attr('id','future-roaming-module');

    futureRoaming.$form = $('<form/>').append(
      // futureRoaming.$elem = $('<div/>').addClass('future-roaming-module-year-div').attr('id','future-roaming-module-year-div');
      $('<div/>').addClass('future-roaming-module-year-div').attr('id','future-roaming-module-year-div').append(
        $('<div/>').addClass('year-div-label').attr('id','year-div-label').append(
          $('<label/>').attr('for','future-roaming-module-year-label').addClass('future-roaming-module-year-label').text('Year travelling')
        ),
        $('<div/>').addClass('year-div-option').attr('id','year-div-option').append(
          $('<select/>').attr('id','future-roaming-module-year').addClass('future-roaming-module-year').append(
            $('<option/>').text('Select'),
            $('<option/>').text('2017'),
            $('<option/>').text('2018'),
            $('<option/>').text('2019'),
            $('<option/>').text('2020')
          )
        )
      ),
      $('<div/>').addClass('future-roaming-module-age-div').attr('id','future-roaming-module-age-div').append(
        $('<div/>').addClass('age-div-label').attr('id','age-div-label').append(
          $('<label/>').attr('for','future-roaming-module-age-label').addClass('future-roaming-module-age-label').text('Age')
        ),
        $('<div/>').addClass('age-div-option').attr('id','age-div-option').append(
          $('<select/>').attr('id','future-roaming-module-age').addClass('future-roaming-module-age').append(
            $('<option/>').text('Select'),
            $('<option/>').text('18-29'),
            $('<option/>').text('30-45'),
            $('<option/>').text('45-60'),
            $('<option/>').text('60+')
          )
        )
      ),
      $('<div/>').addClass('future-roaming-module-season-div').attr('id','future-roaming-module-season-div').append(
        $('<div/>').addClass('season-div-label').attr('id','season-div-label').append(
            $('<label/>').attr('for','future-roaming-module-season-label').addClass('future-roaming-module-season-label').text('Season')
        ),
        $('<div/>').addClass('season-div-option').attr('id','season-div-option').append(
          $('<select/>').attr('id','future-roaming-module-season').addClass('future-roaming-module-season').append(
            $('<option/>').text('Select'),
            $('<option/>').text('Summer'),
            $('<option/>').text('Winter')
          )
        )
      ),
      $('<div/>').addClass('future-roaming-module-reason-div').attr('id','future-roaming-module-reason-div').append(
        $('<div/>').addClass('reason-div-label').attr('id','reason-div-label').append(
          $('<label/>').attr('for','future-roaming-module-reason-label').addClass('future-roaming-module-reason-label').text('Reason for travel')
        ),
        $('<div/>').addClass('reason-div-option').attr('id','reason-div-option').append(
          $('<select/>').attr('id','future-roaming-module-reason').addClass('future-roaming-module-reason').append(
            $('<option/>').text('Select'),
            $('<option/>').text('Culture Shock'),
            $('<option/>').text('Relaxation'),
            $('<option/>').text('Family Time'),
            $('<option/>').text('Exploration')
          )
        )
      )
    );

    futureRoaming.$map = $('<div/>').addClass('map');

    futureRoaming.$country = $('<div/>').addClass('country');

    futureRoaming.$text = $('<div/>').addClass('text');

    futureRoaming.$elem.append(futureRoaming.$form,futureRoaming.$map,futureRoaming.$country,futureRoaming.$text);
    $('.post-content .post-body p').first().after(futureRoaming.$elem);
  }
};
```

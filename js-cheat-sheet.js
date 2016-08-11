//
//
//  JAVASCRIPT DOC READY
//
//

$(document).ready(function () {
  futureRoaming.init();
});

//
//
//  JAVASCRIPT BASIC OBJECT
//
//

var person = {
    firstName:"John",
    lastName:"Doe",
    age:50,
    eyeColor:"blue"
};

//
//
//  JAVASCRIPT OBJECT
//
//

var futureRoaming = {
  themeUrl: $('meta[name=theme_url]').attr('content'),

  //
  //
  //  JAVASCRIPT OBJECT FUNCTION
  //
  //

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
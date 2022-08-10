$(function(){
  'use strict';
    $('.az-sideleft-menu > li').click(function() {
    localStorage.setItem("clicked", $(this).attr("id"))
    $('li').removeClass("active")
    $(this).addClass("active")
    });

    $('.nav-sub > li').click(function() {
    localStorage.setItem("clicked", $(this).attr("id"))
    $('li').removeClass("active")
    $(this).addClass("active")
    });

    $('.nav-item > a').click(function() {
    localStorage.setItem("clicked", $(this).attr("id"))
    $('a').removeClass("active")
    $(this).addClass("active")
    });

    var active = localStorage.getItem("clicked")
    active ? $("#" + active).addClass("active") : $('#home').addClass("active")
});

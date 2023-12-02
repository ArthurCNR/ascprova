$("#registro-campeonato").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

	var file_data = $('#img').prop('files')[0];
	var file_data2 = $('#regulamento').prop('files')[0];
	let form_data = new FormData(this);
	form_data.append('username', $('#registro-campeonato input[username=username]').val(''));
	form_data.append('img', file_data);
	form_data.append('regulamento', file_data2);


	var postData = $(this).serializeArray(),
		formURL = $(this).attr("action"),
		$cfResponse = $('#resposta'),
		$cfsubmit = $("#submit"),
		cfsubmitText = $cfsubmit.text();

	$cfsubmit.text("Enviando...");

	$.ajax(
		{
			url: formURL,
			type: "POST",
			data: form_data,
			processData: false,
			contentType: false,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				console.log(data);
			},
			error: function (data) {
				console.log(data);
			}
		});

	return false;

});

$(document).ready(function() {
	// Adiciona a classe "hovered" quando o mouse passa sobre a div
	$(".my-card").hover(function() {
		$(this).addClass("hovered");
	}, function() {
		// Remove a classe "hovered" quando o mouse sai da div
		$(this).removeClass("hovered");
	});
});

$(document).ready(function() {
	// Quando a div com a classe "my-card" é clicada
	$(".my-card.new").click(function() {
		var novaPagina = $(this).data("page");

		var currentURL = window.location.href;
		var hasPageParam = currentURL.includes("&page=");
		if (hasPageParam) {
			var newURL = currentURL.replace(/&page=[^&]*/, "&page=" + novaPagina);
		} else {
			var newURL = currentURL + "&page=" + novaPagina;
		}

		// Redirecione para a nova URL
		window.location.href = newURL;
	});
});

$("#registro-etapa").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

	let form_data = new FormData(this);

	var postData = $(this).serializeArray(),
		formURL = $(this).attr("action"),
		$cfResponse = $('#resposta'),
		$cfsubmit = $("#submit2"),
		cfsubmitText = $cfsubmit.text();

	$cfsubmit.text("Enviando...");

	$.ajax(
		{
			url: formURL,
			type: "POST",
			data: form_data,
			processData: false,
			contentType: false,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				console.log(data);
			},
			error: function (data) {
				console.log(data);
			}
		});

	return false;

});

$("#registro-categoria").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

	let form_data = new FormData(this);

	var postData = $(this).serializeArray(),
		formURL = $(this).attr("action"),
		$cfResponse = $('#resposta'),
		$cfsubmit = $("#submit"),
		cfsubmitText = $cfsubmit.text();

	$cfsubmit.text("Enviando...");

	$.ajax(
		{
			url: formURL,
			type: "POST",
			data: form_data,
			processData: false,
			contentType: false,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				console.log(data);
			},
			error: function (data) {
				console.log(data);
			}
		});

	return false;

});

$("#registro").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

	let form_data = new FormData(this);

	var postData = $(this).serializeArray(),
		formURL = $(this).attr("action"),
		$cfResponse = $('#resposta'),
		$cfsubmit = $("#submit"),
		cfsubmitText = $cfsubmit.text();

	$cfsubmit.text("Enviando...");

	$.ajax(
		{
			url: formURL,
			type: "POST",
			data: form_data,
			processData: false,
			contentType: false,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				console.log(data);
			},
			error: function (data) {
				console.log(data);
			}
		});

	return false;

});

$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	jQuery('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	// $('.user-area> a').on('click', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
	// 	$('.user-menu').parent().removeClass('open');
	// 	$('.user-menu').parent().toggleClass('open');
	// });


});
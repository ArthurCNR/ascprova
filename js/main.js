$("#registro-form").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

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
			data: postData,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				$('#registro-form input[nome=nome]').val('');
				$('#registro-form input[email=email]').val('');
				$('#registro-form input[telefone=telefone]').val('');
				$('#registro-form input[organizacao=organizacao]').val('');
				$('#registro-form input[senha=senha]').val('');
			},
			error: function (data) {
				alert("Error occurd! Please try again");
			}
		});

	return false;

});

$("#login-form").submit(function (e) {

	e.preventDefault();
	var $ = jQuery;

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
			data: postData,
			success: function (data) {
				$cfResponse.html(data);
				$cfsubmit.text(cfsubmitText);
				$('#login-form input[email=email]').val('');
				$('#login-form input[senha=senha]').val('');
			},
			error: function (data) {
				alert("Error occurd! Please try again");
			}
		});

	return false;

});

$(document).ready(function () {
	$('#telefone').on('input', function () {
		// Remove todos os caracteres não numéricos.
		var phoneNumber = $(this).val().replace(/\D/g, '');

		// Formata o número de telefone.
		if (phoneNumber.length >= 2) {
			phoneNumber = '(' + phoneNumber.substring(0, 2) + ') ' + phoneNumber.substring(2);
		}
		if (phoneNumber.length >= 10) {
			phoneNumber = phoneNumber.substring(0, 10) + '-' + phoneNumber.substring(10);
		}

		// Limita o tamanho do campo a 15 caracteres.
		if (phoneNumber.length > 15) {
			phoneNumber = phoneNumber.substring(0, 15);
		}

		// Define o valor formatado de volta no campo.
		$(this).val(phoneNumber);
	});
});

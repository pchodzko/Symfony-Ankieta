/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


const $ = require('jquery');
require('jquery-ui-bundle');
require('jquery-validation');
require('bootstrap');

$(document).ready(function () {
    $('#survey_next').click(function (e) {
        // e.preventDefault()
        $('#myTab a').last().tab('show');
    });
    $('#survey_back').click(function (e) {
        // e.preventDefault()
        $('#myTab a').first().tab('show');
    });
    $('#myTab a').click(function (e) {
        return false;
        e.preventDefault()
    });
    $("#survey_DOB").on("focus", function () {
        $(this).effect('shake', 'left', 500);
        return false;
    });
    jQuery.validator.addMethod("polishlettersonly", function (value, element) {
        return this.optional(element) || /^\S[a-zęóąśłżźćń+?\-]+\S$/i.test(value);
    }, "{% trans %}form.validator.polishlettersonly{% endtrans %}");
    jQuery.validator.addMethod("dateFormat",
            function (value, element) {
                return value.match(/^(\d{4})-(\d{1,2})-(\d{1,2})$/);
            }, "{% trans %}form.validator.dateFormat{% endtrans %}");
    $('[name="survey"]').validate({
        debug: true,
        errorClass: 'error',
        ignore: [],
        rules: {
            "survey[DOB]": {
                required: true,
                dateFormat: true,

            },
            "survey[lastName]": {
                required: true,
                minlength: 3,
                polishlettersonly: true,
            },
            "survey[firstName]": {
                required: true,
                minlength: 3,
                polishlettersonly: true,
            },
        },
        messages: {
            "iflow_RestBundle_customer[firstName]": {
                polishlettersonly: "{% trans %}form.validator.first_name.lettersonly{% endtrans %}",
                required: "{% trans %}form.validator.first_name.required{% endtrans %}",
                minlength: "{% trans %}form.validator.first_name.minLength{% endtrans %}"
            },
            "iflow_RestBundle_customer[lastName]": {
                polishlettersonly: "{% trans %}form.validator.last_name.lettersonly{% endtrans %}",
                required: "{% trans %}form.validator.last_name.required{% endtrans %}",
                minlength: "{% trans %}form.validator.last_name.minLength{% endtrans %}"
            },
            "survey[DOB]": {
                email: "{% trans %}form.validator.email.email{% endtrans %}",
                required: "{% trans %}form.validator.email.required{% endtrans %}",
                minlength: "{% trans %}form.validator.email.minLength{% endtrans %}"
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "survey[DOB]") {
                $('#myTab a').first().tab('show');
                error.insertAfter(element);
            } else {
                //$('#myTab a').last().tab('show');
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
});
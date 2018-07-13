/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


const $ = require('jquery');
require('jquery-ui-bundle');
require('jquery-validation');
require('bootstrap');
const Translator = require('bazinga-translator');
global.Translator = Translator;
require('./translations/config');
require('./translations/messages/pl');

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
                polishlettersonly: Translator.trans('form.validator.first_name.lettersonly', {}, 'messages'),
                required: Translator.trans('form.validator.first_name.required', {}, 'messages'),
                minlength: Translator.trans('form.validator.first_name.required', {}, 'messages')
            },
            "iflow_RestBundle_customer[lastName]": {
                polishlettersonly:Translator.trans('form.validator.last_name.lettersonly', {}, 'messages'),
                required: Translator.trans('form.validator.last_name.required', {}, 'messages') ,
                minlength: Translator.trans('form.validator.last_name.minLength', {}, 'messages')
            },
            "survey[DOB]": {
                dateFormat: Translator.trans('form.validator.dob.dateFormat', {}, 'messages'),
                required: Translator.trans('form.validator.dob.required', {}, 'messages') ,
                minlength: Translator.trans('form.validator.dob.minLength', {}, 'messages')
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
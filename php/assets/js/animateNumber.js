jQuery(document).ready(function($) {
    var startAt = 5321275190;
    var currentNumber = startAt;
    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');

    $('#stolen-amount').prop('number', 0).animateNumber(
        {
            number: currentNumber,
            numberStep: comma_separator_number_step
        },
        1800
    );

    setInterval(function(){
        $('#stolen-amount').animateNumber(
            {
                number: currentNumber,
                numberStep: comma_separator_number_step
            },
            1800
        );

        currentNumber = currentNumber + 7;
    }, 1000);
});
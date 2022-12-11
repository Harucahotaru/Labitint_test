$(".button-update").click(function()
{
    $.ajax({
        url: "/index.php?r=currency-weather/get-data",
        beforeSend: function() {$('.button-update').attr("disabled", true);
        },
        success: function(res) {
            $('.whether-location').text(res.weather.location[0]);
            $('.whether-time').text(res.weather.time);
            $('.whether-temp').text(res.weather.temp[0]);
            $('.whether-feelslik').text(res.weather.feelslik[0]);
            $('.whether-condition').text(res.weather.condition[0]);
            $.each(res.currency, function (currencyType, currencyAttributes) {
                className = '.' + currencyType + '-value';
                $(className).text(parseInt(currencyAttributes.Value));
            });
            $('.button-update').attr("disabled", false);
        },
    });
    return false;
});
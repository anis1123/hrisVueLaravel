<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.0/dist/nepaliDatePicker.min.css" integrity="sha384-Fligaq3qH5qXDi+gnnhQctSqfMKJvH4U8DTA+XGemB/vv9AUHCwmlVR/B3Z4nE+q" crossorigin="anonymous">


<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/nepali-date-picker@2.0.0/dist/jquery.nepaliDatePicker.min.js" integrity="sha384-bBN6UZ/L0DswJczUYcUXb9lwIfAnJSGWjU3S0W5+IlyrjK0geKO+7chJ7RlOtrrF" crossorigin="anonymous"></script>


<p>
    <label>DOB: </label>
    <input type="text" value="" name="date" class="bod-picker" placeholder="Select Date of Birth">
    <button id="clear-bth" onclick="">Clear</button>

</p>

<script>
$(".bod-picker").nepaliDatePicker({
    dateFormat: "%y-%m",
    closeOnDateSelect: true
});

function eventLog(event){
    var datePickerData = event.datePickerData;
    var outputData = {
        "type": event.type,
        "message": event.message,
        "datePickerData": datePickerData
    };

    var output = '<p><code>▸ ' + JSON.stringify(outputData) + '</code></p>';
    $('.output').append(output);
}

$(".bod-picker").on("show", function (event) {
    var output = '<p><code>▸ Show event trigger</code></p>';
    $('.output').append(output);
});

// $(".bod-picker").on("yearChange", function (event) {
//     console.log(event);
// });

// $(".bod-picker").on("monthChange", function (event) {
//     console.log(event);
// });

// $(".bod-picker").on("dateChange", function (event) {
//     console.log(event);
// });

$(".bod-picker").on("dateSelect", function (event) {
    console.log(event.datePickerData.bsMonthDays);
});


$("#clear-bth").on("click", function(event) {
  alert($('.bod-picker').val())
});
</script>

</body>
</html>

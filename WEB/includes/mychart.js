$(document).ready(function(){
    $.ajax({
        url: "/hp1/s/sql_bar_script.php",
        method: "GET",

        success: function(data){
            console.log(data);
            var date_ = [];
            var consumption = [];

            for (var i in data){
                date_.push(data[i].date);
                consumption.push(data[i].consumption);
            }

            var chartdata = {
                labels : date_,
                datasets : [{
                    label : 'Daily Consumption in kWh',
                    backgroundColor: '#787878',
                    data: consumption
                }]
            };

            var ctx = $("#myChartID");
            var bargraph = new Chart(ctx,{
                type: 'bar',
                data: chartdata
            });
        },

        error: function(data){
            console.log(data);
        }
    });
});
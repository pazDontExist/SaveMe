
<script>
    /*
    *  Document   : base_pages_dashboard.js
    *  Author     : pixelcave
    *  Description: Custom JS code used in Dashboard Page
    */

    var BasePagesDashboard = function () {
// Chart.js Chart, for more examples you can check out http://www.chartjs.org/docs
        var initDashChartJS = function () {
// Get Chart Container
            var $dashChartLinesCon = jQuery('.js-dash-chartjs-lines')[0].getContext('2d');

// Set Chart and Chart Data variables
            var $dashChartLines, $dashChartLinesData;

// Lines Chart Data
            var $dashChartLinesData = {
                <?php graph_data();?>
            };

// Init Lines Chart
            $dashChartLines = new Chart($dashChartLinesCon).Line($dashChartLinesData, {
                scaleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
                scaleFontColor: '#999',
                scaleFontStyle: '600',
                tooltipTitleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
                tooltipCornerRadius: 3,
                maintainAspectRatio: false,
                responsive: true
            });
        };

        var initInfo = function () {
            $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=active_bartop", function (data) {

                $("#active_bartop").text(data);
                $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=today_netwin", function (data) {

                    $(".today_netwin").text("$ " + data);
                    $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=win_average", function (data) {

                        $("#win_avg").text("$ " + data);
                        $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=bet_average", function (data) {

                            $("#bet_avg").text("$ " + data);
                            $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=active_pds_bartop", function (data) {
                                $("#table_content").html(data);
                                $.get("index.php?dispatch&token=e8a1273H7a120e7a&method=game_of_the_month", function (data) {
                                    $("#game_month").html(data);
                                });
                            });
                        });
                    });
                });
            });
        };

        return {
            init: function () {
// Init ChartJS chart
                initDashChartJS();
                initInfo();
            }
        };
    }();

    // Initialize when page loads
    jQuery(function () {
        BasePagesDashboard.init();
    });
</script>

<script>
    jQuery(function () {
        // Init page helpers (Slick Slider plugin)
        App.initHelpers('slick');
    });
</script>


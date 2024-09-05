<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>



<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->

        <?php include 'includes/top-bar.php'; ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <?php include 'includes/sidebar.php'; ?>


        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->

                    <div class="row">



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Overall health</h5>
                                <div class="card-body">
                                    <p>
                                        This summary reflects specific measures for immunity, inflammation, metabolism,
                                        current risk factors, cardiovascular health, liver health and kidney health.
                                        These are assessed to determine if the measures are within range (green), at
                                        risk (amber), or out of range (red). The Overall Status indicator gives an
                                        overview of the percentage of your current measures that fall within green
                                        (within range), amber (at risk) or red (out of range) ranges. Please note that
                                        for some measures, our ranges may differ from the values that the laboratories
                                        deem to be ‘normal’, and this reflects the prioritization we place on optimizing
                                        certain markers given the evidence for their importance in measuring metabolic
                                        and inflammatory health.
                                    </p>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="card">
                                                <h5 class="card-header">Overall Health Status </h5>
                                                <div class="card-body">
                                                    <div id="morris_chart1"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="card">
                                                <h5 class="card-header">Heart & Kidney Health </h5>
                                                <div class="card-body">
                                                    <div id="morris_chart2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="card">
                                                <h5 class="card-header">Renal Profile </h5>
                                                <div class="card-body">
                                                    <div id="morris_chart3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            
                            <div class="accrodion-regular">
                                <div id="accordion3">
                                    <div class="card">
                                        <div class="card-header" id="headingSeven">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                    data-target="#collapseSeven" aria-expanded="true"
                                                    aria-controls="collapseSeven">
                                                    <span class="fas fa-angle-down mr-3"></span>Blood Test Results
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven"
                                            data-parent="#accordion3">
                                            <div class="card-body">
                                                <p class="lead"> Anim pariatur cliche reprehenderit, enim eiusmod high
                                                    life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch.</p>
                                                <p> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                    tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                    nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                    beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                                                <a href="#" class="btn btn-secondary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header" id="headingEight">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseEight" aria-expanded="false"
                                                    aria-controls="collapseEight">
                                                    <span class="fas fa-angle-down mr-3"></span>Health Questionnaire
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                                            data-parent="#accordion3">
                                            <div class="card-body">
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header" id="headingNine">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseNine" aria-expanded="false"
                                                    aria-controls="collapseNine">
                                                    <span class="fas fa-angle-down mr-3"></span>Results & Suggestions
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine"
                                            data-parent="#accordion3">
                                            <div class="card-body">
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-tabhetic synth nesciunt you probably haven't heard of them
                                                accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php include 'includes/footer-js.php'; ?>

    <script src="../siteimages/dash/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="../siteimages/dash/assets/vendor/charts/morris-bundle/morris.js"></script>
    <script src="../siteimages/dash/assets/vendor/charts/morris-bundle/Morrisjs.js"></script>
    <script src="../siteimages/dash/assets/libs/js/main-js.js"></script>
    <script>
        $(document).ready(function () {
            $("#btnShow").click(function () {
                $("#divFacts").show();
                $("#divFacts").append("<b>Welcome to admin portal, you can manage cars, owners and owned cars from here dynamically. For further queries can contact by emailing on test@contact.com</b>").show('slowly');
                $("#divFacts").animate(1000)
            });

        })
    </script>
    <script>
            (function (window, document, $, undefined) {
                "use strict";
                $(function () {

                    if ($('#morris_chart1').length) {
                        Morris.Donut({
                            element: 'morris_chart1',

                            data: [
                                { value: 40, label: 'Out of Range' },
                                { value: 25, label: 'Within Range' },
                                { value: 30, label: 'At Risk' }
                            ],

                            labelColor: '#2e2f39',
                            gridTextSize: '14px',
                            colors: [
                                "#dc3545",
                                "#28a745",
                                "#ffc107"],

                            formatter: function (x) { return x + "%" },
                            resize: true
                        });
                    }

                    if ($('#morris_chart2').length) {
                        Morris.Donut({
                            element: 'morris_chart2',

                            data: [
                                { value: 60, label: 'Out of Range' },
                                { value: 30, label: 'Within Range' },
                                { value: 40, label: 'At Risk' }
                            ],

                            labelColor: '#2e2f39',
                            gridTextSize: '14px',
                            colors: [
                                "#dc3545",
                                "#28a745",
                                "#ffc107"],

                            formatter: function (x) { return x + "%" },
                            resize: true
                        });
                    }

                    if ($('#morris_chart3').length) {
                        Morris.Donut({
                            element: 'morris_chart3',

                            data: [
                                { value: 10, label: 'Out of Range' },
                                { value: 75, label: 'Within Range' },
                                { value: 15, label: 'At Risk' }
                            ],

                            labelColor: '#2e2f39',
                            gridTextSize: '14px',
                            colors: [
                                "#dc3545",
                                "#28a745",
                                "#ffc107"],

                            formatter: function (x) { return x + "%" },
                            resize: true
                        });
                    }








                });

            })(window, document, window.jQuery);
    </script>
</body>

</html>
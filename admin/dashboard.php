<div>
    <div class="row chart-container">
        <div id="project_overview" class="col-md-6 text-center">
            <h3> Project Status Overview </h3>
            <canvas id="project_overview_chart"></canvas>
        </div>

        <figure class="highcharts-figure col-md-6 text-center">
            <h3> Remaining Budget </h3>
            <div id="project_budget_overview_chart"></div>
        </figure>
    </div>

    <div class="row chart-container">
        <div id="project_tasks" class="col-md-12 text-center">
            <h3> Project Tasks Overview </h3>
            <canvas id="project_tasks_chart"></canvas>
        </div>
    </div>

    <div class="row chart-container">
        <div id="project_tasks_progress" class="col-md-12 text-center">
            <h3> Project Tasks Progress </h3>
            <canvas id="project_tasks_progress_chart"></canvas>
        </div>
    </div>

    <!-- HighCharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script> -->

    <script>
        $(document).ready(function () {
            showProjectStatusOverview();
            showProjectBudgetOverview();
            showTaskSpendingOverview();
            showTasksCompletionOverview();
        });


        function showProjectStatusOverview() {
            $.ajax({
                url : 'dashboard_reports/project_data.php',
                type : 'POST',
                success : function (results) {
                    data = [];
                    labels = [];
                    colors = []
                    project_mapping = [
                        {"status": 0, "label": "Pending", "color": "#f8ce2c"},
                        {"status": 1, "label": "Started", "color": "#6aa338"},
                        {"status": 2, "label": "In Progress", "color": "#17a9d6"},
                        {"status": 3, "label": "Cancelled", "color": "#f00b2c"},
                        {"status": 5, "label": "Done", "color": "#339057"}
                    ];
                    project_mapping.forEach(mapping => {
                        result = results.filter(res => res['status'] == mapping['status']).length;
                        percentage = (result/results.length) * 100;
                        data.push(result);
                        labels.push(mapping['label'] + " " + percentage + "%");
                        colors.push(mapping['color']);
                    })

                    const centerText = {
                        id: 'centerText',
                        beforeDatasetsDraw(chart, args, pluginOptions) {
                            const { ctx, data } = chart;
                            const text = "Total Projects: " + results.length;

                            ctx.save();
                            const x = chart.getDatasetMeta(0).data[0].x;
                            const y = chart.getDatasetMeta(0).data[0].y;

                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.font = 'bold 20px sans-serif';
                            ctx.fillText(text, x, y);
                        }
                    }

                    const chart_data = {
                        labels: labels,
                        datasets: [{
                            label: 'Project Status Overview',
                            data: data,
                            backgroundColor: colors,
                            hoverOffset: 4
                        }]
                    };

                    Chart.overrides['doughnut'].plugins.legend.position = "bottom";

                    var graphTarget = document.getElementById('project_overview_chart');

                    var barGraph = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chart_data,
                        options: {
                            aspectRatio: 1,
                            responsive: true,
                            cutout: 100
                        },
                        plugins: [centerText]
                    });
                },
                error : function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function showProjectBudgetOverview() {
            $.ajax({
    url: 'get_current_budget.php', // Updated to the new PHP script
    type: 'GET', // Changed to GET if no data needs to be sent
    dataType: 'json', // Expecting JSON response
    success: function(result) {
        const budgetRemaining = parseInt(result.budget_remaining);

        const formatter = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
        });

        const totalBudgetRemaining = formatter.format(budgetRemaining);
 
        Highcharts.chart('project_budget_overview_chart', {
            chart: { type: 'pie' },
            title: { text: null },
            subtitle: {
                text: `Budget Remaining <br> ${totalBudgetRemaining}`,
                align: "center",
                verticalAlign: "middle",
                style: {
                    "fontSize": "15px",
                    "textAlign": "center"
                },
                x: 0,
                y: 20,
                useHTML: true
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    dataLabels: {
                        enabled: true
                    },
                    states: {
                        hover: {
                            enabled: false
                        }
                    },
                    size: "100%",
                    innerSize: "100%",
                    borderColor: null,
                    borderWidth: 8
                }
            },
            tooltip: {
                valueSuffix: ' PHP'
            },
            series: [{
                innerSize: '70%',
                data: [
                    {
                        name: 'Budget Remaining',
                        y: budgetRemaining,
                        color: '#41b4d3'
                    }
                ]
            }],
            exporting: { enabled: false },
            credits: { enabled: false },
        });
    },
    error: function(xhr, status, error) {
        console.log(xhr.responseText);
    }
});
        }

        function showTaskSpendingOverview() {
            $.ajax({
                url : 'dashboard_reports/project_task_data.php',
                type : 'POST',
                success : function (results) {
                    // Tasks grouped by project
                    const grouped_tasks = _.groupBy(results, res => res.project_id);
                    const datapoints = results.map(res => {
                        const project_overall_cost = res.overall_cost
                        const project_tasks = grouped_tasks[res.project_id]
                        const completed_tasks = project_tasks.filter(task => task.status == 3)
                        const project_completion_percentage = completed_tasks.length/project_tasks.length

                        // Earned Value (EV) = total project budget multiplied by the % of project completion???????
                        const earned_value = project_overall_cost * project_completion_percentage
                        // SV = EV - PV (planned value/estimated cost)
                        const schedule_variance = earned_value - res.estimated_cost
                        // CV = EV - AC (actual cost)
                        const cost_variance = earned_value - res.actual_cost
                        // SPI = EV / PV
                        const schedule_performance_index = earned_value / res.estimated_cost
                        console.log("SPI ======> " + schedule_performance_index)

                        return {
                            actual_cost: res.actual_cost,
                            estimated_cost: res.estimated_cost,
                            earned_value: earned_value,
                            schedule_variance: schedule_variance,
                            cost_variance: cost_variance,
                            schedule_performance_index: schedule_performance_index
                        }
                    })

                    var graphTarget = document.getElementById('project_tasks_chart');

                    var myChart = new Chart(graphTarget, {
                        type: 'line',
                        data: {
                            labels: results.map(res => res.start_date),
                            datasets: [
                                {
                                    label: 'Actual Cost', 
                                    data: datapoints.map(datapoint => datapoint.actual_cost),
                                    fill: false,
                                    borderColor: '#f00b2c',
                                    backgroundColor: '#f00b2c',
                                    borderWidth: 1 
                                },
                                {
                                    label: 'Estimated Cost',
                                    data: datapoints.map(datapoint => datapoint.estimated_cost),
                                    fill: false,
                                    borderColor: '#2196f3', 
                                    backgroundColor: '#2196f3', 
                                    borderWidth: 1 
                                },
                                {
                                    label: 'Earned Value',
                                    data: datapoints.map(datapoint => datapoint.earned_value),
                                    fill: false,
                                    borderColor: '#339057', 
                                    backgroundColor: '#339057', 
                                    borderWidth: 1 
                                },
                                {
                                    label: 'Schedule Variance',
                                    data: datapoints.map(datapoint => datapoint.schedule_variance),
                                    fill: false,
                                    borderColor: 'pink', 
                                    backgroundColor: 'pink', 
                                    borderWidth: 1 
                                },
                                {
                                    label: 'Cost Variance',
                                    data: datapoints.map(datapoint => datapoint.cost_variance),
                                    fill: false,
                                    borderColor: 'purple', 
                                    backgroundColor: 'purple', 
                                    borderWidth: 1 
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function(value, index, ticks) {
                                            return 'PHP ' + value;
                                        }
                                    },
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Start Date'
                                    }
                                }
                            }
                        }
                    });
                },
                error : function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function showTasksCompletionOverview() {
            $.ajax({
                url : 'dashboard_reports/project_task_data.php',
                type : 'POST',
                success : function (results) {
                    const projects = [...new Map(results.map(item => [item['project_id'], item])).values()]

                    const grouped_tasks = _.groupBy(results, res => res.project_id);
                    const datapoints = projects.map(project => {
                        const tasks = grouped_tasks[project.project_id]

                        const project_overall_cost = project.overall_cost
                        const completed_tasks = tasks.filter(task => task.status == 3)
                        const project_completion_percentage = completed_tasks.length/tasks.length

                        // Earned Value (EV) = total project budget multiplied by the % of project completion???????
                        const earned_value = project_overall_cost * project_completion_percentage
                        

                        console.log("2222 EVM ====> " + earned_value)

                        return {
                            project_id: project.project_id,
                            project_name: project.project,
                            pending_count: tasks.filter(task => task.status == 1).length,
                            in_progress_count: tasks.filter(task => task.status == 2).length,
                            completed_count: tasks.filter(task => task.status == 3).length
                        }
                    })

                    var barChartData = {
                        labels: datapoints.map(datapoint => datapoint.project_name),
                        datasets: [
                            {
                                label: "Pending Tasks",
                                backgroundColor: '#f8ce2c',
                                borderColor: '#f8ce2c',
                                borderWidth: 1,
                                data: datapoints.map(datapoint => datapoint.pending_count)
                            },
                            {
                                label: "In Progress Tasks",
                                backgroundColor: '#17a9d6',
                                borderColor: '#17a9d6',
                                borderWidth: 1,
                                data: datapoints.map(datapoint => datapoint.in_progress_count)
                            },
                            {
                                label: "Completed Tasks",
                                backgroundColor: '#339057',
                                borderColor: '#339057',
                                borderWidth: 1,
                                data: datapoints.map(datapoint => datapoint.completed_count)
                            }
                        ]
                    };

                    var chartOptions = {
                        responsive: true,
                        legend: {
                            position: "top"
                        },
                        scales: {
                            y: {
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        }
                    }

                    var graphTarget = document.getElementById('project_tasks_progress_chart');

                    var myChart = new Chart(graphTarget, {
                        type: "bar",
                        data: barChartData,
                        options: chartOptions
                    });
                },
                error : function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>

</div>
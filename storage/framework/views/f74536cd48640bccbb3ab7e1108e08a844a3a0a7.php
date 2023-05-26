<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Store Analytics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Store Analytics')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row gy-4">
            <div class="col-lg-12">
                <h4 class="mb-2"><?php echo e(__('Visitor')); ?></h4>
                <div class="card shadow-none mb-0">
                    <div class="card-body p-3 rounded border">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div id="Analytics"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4 class="mb-2"><?php echo e(__('Top URL')); ?></h4>
                <div class="card shadow-none mb-0">
                    <div class="card-body  rounded border">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="bg-transparent"><?php echo e(__('Url')); ?></th>
                                        <th class="bg-transparent"><?php echo e(__('Views')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $visitor_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a href="<?php echo e($url->url); ?>"><?php echo e($slug); ?></a></td>
                                            <td><?php echo e($url->total); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h4 class="mb-2"><?php echo e(__('Platform')); ?></h4>
                <div class="card shadow-none mb-0">
                    <div class="card-body rounded border">
                        <div class="d-flex align-items-center">
                            <h3 class="flex-grow-1 mb-0"><?php echo e(__('Analytics')); ?></h3>
                        </div>
                        <div class="tab-content" id="analyticsTabContent">
                            <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab1">
                                <div id="user-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6"> 
                <h4><?php echo e(__('Device')); ?></h4>
                <div class="card shadow-none mb-0">
                    <div class="card-body rounded border">
                        
                        <div class="tab-content" id="analyticsTabContent">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                               <div id="WebKit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6"> 
                <h4><?php echo e(__('Browser')); ?></h4>
                <div class="card shadow-none mb-0">
                    <div class="card-body rounded border">
                        
                        <div class="tab-content" id="analyticsTabContent">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                               <div id="Safari"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        (function () {
                var options = {
                    chart: {
                        height: 300,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: [{
                        name: "<?php echo e(__('Refferal')); ?>",
                        data: <?php echo json_encode($chartData['data']); ?>

                    }, {
                        name: "<?php echo e(__('Organic search')); ?>",
                        data: <?php echo json_encode($chartData['unique_data']); ?>

                    }],
                    xaxis: {
                        categories: <?php echo json_encode($chartData['label']); ?>,
                        title: {
                            text: 'Days'
                        }
                    },
                    colors: ['#ffa21d', '#FF3A6E'],
        
                    grid: {
                        strokeDashArray: 4,
                        show: false,
                    },
                    legend: {
                        show: false,
                    },
                    
                    yaxis: {
                        tickAmount: 3,
                    },
                   
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: "horizontal",
                            shadeIntensity: 0,
                            gradientToColors: undefined, 
                            inverseColors: true,
                            opacityFrom: 0,
                            opacityTo: 0,
                            stops: [0, 50, 100],
                            colorStops: []
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#Analytics"), options);
                chart.render();
            })();
            (function () {
                var options = {
                    chart: {
                        type: 'bar',
                        height: 140,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    
                    plotOptions: {
                        bar: {
                            color: '#fff',
                            columnWidth: '20%',
                        }
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1,
                    },
                    series: [{
                        name: "<?php echo e(__('Platform')); ?>",
                        data: <?php echo json_encode($platformarray['data']); ?>,
                    }],
                    colors: ['#6FD943','#162C4E','#DAE0E0','#316849','#1A3C4E','#203E4C'],
                    xaxis: {
                        labels: {
                            // format: 'MMM',
                            style: {
                                colors: PurposeStyle.colors.gray[600],
                                fontSize: '14px',
                                fontFamily: PurposeStyle.fonts.base,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: true,
                            borderType: 'solid',
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        },
                        title: {
                            text: '<?php echo e(__('Platform')); ?>'
                        },
                        categories: <?php echo json_encode($platformarray['label']); ?>,
                    },
                    yaxis: {
                        tickAmount: 4,
                        labels: {
                            style: {
                                colors: "#000",
                            }
                        },
                    },
                    grid: {
                        borderColor: '#ffffff00',
                        padding: {
                            bottom: 0,
                            left: 10,
                        }
                    },
                    tooltip: {
                        fixed: {
                            enabled: false
                        },
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function (seriesName) {
                                    return 'Total Earnings'
                                }
                            }
                        },
                        marker: {
                            show: false
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#user-chart"), options);
                chart.render();
            })();
        
            var options = {
                    series: <?php echo json_encode($devicearray['data']); ?>,
                    chart: {
                        width: 450,
                        type: 'pie',
                    },
                    colors: ["#6FD943", "#316849", "#1A3C4E", "#EBF7E7", " #EBEDEF"],
                    labels: <?php echo json_encode($devicearray['label']); ?>,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(document.querySelector("#WebKit"), options);
                chart.render();
                var options = {
                    series: <?php echo json_encode($browserarray['data']); ?>,
                    chart: {
                        width: 450,
                        type: 'pie',
                    },
                    colors: ["#6FD943", "#316849", "#1A3C4E", "#EBF7E7", " #EBEDEF"],
                    labels: <?php echo json_encode($browserarray['label']); ?>,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(document.querySelector("#Safari"), options);
                chart.render();
        </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/store-analytic.blade.php ENDPATH**/ ?>
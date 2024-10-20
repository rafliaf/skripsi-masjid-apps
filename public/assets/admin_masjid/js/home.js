// chart perbandingan usia

Highcharts.chart('chartPerbandinganUsia', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Perbandingan Usia',
        align: 'center'
    },
    xAxis: {
        title: {
            text: 'Kategori rentang usia'
        },
        categories: ['5-9 th', '10-19 th', '20-55 th', '>55 th'],
        crosshair: true,
    },
    yAxis: {
        title: {
            text: 'Jumlah warga'
        }
    },
    tooltip: {
        valueSuffix: ' orang'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Laki-laki',
            data: maleData,
            color: '#1f77b4' // Custom color for Laki-laki series
        },
        {
            name: 'Perempuan',
            data: femaleData,
            color: '#36ad88' // Custom color for Perempuan series
        }
    ]
});

// CHART IBADAH
if (typeof ibadahData !== 'undefined') {
    // chart ibadah
    Highcharts.chart('chartIbadah', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Ibadah'
        },
        xAxis: {
            categories: ['Sholat 5 waktu', 'Sholat berjamaah', 'Zakat fitrah', 'Zakat mal', 'Qurban', 'Haji', 'Pengajian']
        },
        yAxis: {
            title: {
                text: 'Jumlah warga'
            }
        },
        tooltip: {
            valueSuffix: ' orang'
        },
        series: [
            {
                name: 'Jumlah warga yang melakukan ibadah',
                data: [
                    ibadahData.sholat5Waktu,
                    ibadahData.sholatBerjamaah,
                    ibadahData.zakatFitrah,
                    ibadahData.zakatMal,
                    ibadahData.kurban,
                    ibadahData.haji,
                    ibadahData.pengajian
                ],
                color: '#146b2e'
            }
        ]
    });
} else {
    console.error('Ibadah data is not available.');
}

// CHART MENGAJI
if (typeof mengajiData !== 'undefined') {
    // chart mengaji
    Highcharts.chart('chartMengaji', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Kemampuan Baca Quran'
        },
        xAxis: {
            categories: ['Al-Quran', 'Iqra', 'Hijaiyah', 'Latin'] // Correct category names
        },
        yAxis: {
            title: {
                text: 'Jumlah warga'
            }
        },
        tooltip: {
            valueSuffix: ' orang'
        },
        series: [
            {
                name: 'Jumlah Warga',
                data: [
                    mengajiData.bacaQuran,
                    mengajiData.bacaIqro,
                    mengajiData.bacaHijaiyah,
                    mengajiData.bacaLatin
                ],
                color: '#16ab9e'
            }
        ]
    });
} else {
    console.error('Mengaji data is not available.');
}


// chart level ekonomi
// Ensure ekonomiData is available
if (typeof ekonomiData !== 'undefined') {
    // Build the Level Ekonomi chart
    Highcharts.chart('chartLevelEkonomi', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Level Ekonomi',
            align: 'center'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<span style="font-size: 1.2em"><b>{point.name}</b>' +
                        '</span><br>' +
                        '<span style="opacity: 0.6">{point.percentage:.1f} ' +
                        '%</span>',
                    connectorColor: 'rgba(128,128,128,0.5)'
                },
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            }
        },
        series: [{
            name: 'Jumlah warga',
            data: [
                { 
                    name: 'Menengah ke atas', 
                    y: ekonomiData.menengahKeAtas // Accessing the data from ekonomiData object
                },
                { 
                    name: 'Menengah', 
                    y: ekonomiData.menengah // Accessing the data from ekonomiData object
                },
                { 
                    name: 'Menengah ke bawah', 
                    y: ekonomiData.menengahKeBawah // Accessing the data from ekonomiData object
                }
            ]
        }]
    });
} else {
    console.error('Ekonomi data is not available.');
}


// chart pendidikan
Highcharts.chart('chartPendidikan', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Pendidikan'
    },
    xAxis: {
        categories: [
            'Tidak/belum sekolah', 'PAUD', 'TK/taman kanak-kanak', 
            'SD/sekolah dasar', 'SMP/sederajat', 'SMK/sederajat', 
            'SMA/sederajat', 'Diploma I', 'Diploma II', 'Diploma III', 
            'Diploma IV', 'Sarjana S1', 'Sarjana S2', 'Sarjana S3'
        ],
        tickPadding: 20, // Adds space between the tick marks and the labels
        labels: {
            style: {
                fontSize: '12px',
            }
        }
    },
    yAxis: {
        title: {
            text: 'Jumlah Warga'
        }
    },
    series: [{
        name: 'Jumlah warga',
        data: pendidikanData,
        color: '#215682'
    }]
});

// chart pekerjaan
Highcharts.chart('chartPekerjaan', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Pekerjaan'
    },
    xAxis: {
        categories: categoriesPekerjaan // Dynamically pass the job categories
    },
    yAxis: {
        title: {
            text: 'Jumlah Warga'
        }
    },
    series: [{
        name: 'Jumlah warga',
        data: dataPekerjaan, // Dynamically pass the job counts
        color: '#854124'
    }]
});

// chart remaja masjid
// chart jml remaja
Highcharts.chart('jumlahRemaja', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'Total<br/>' +
                            '<strong>90 orang</strong>'
                        )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                    (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 12}px`
                });
            }
        }
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    title: {
        text: 'Remaja Masjid'
    },
    subtitle: {
        text: 'Jumlah laki-laki, perempuan, dan anggota remaja masjid'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 20,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: -15,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'Registrations',
        colorByPoint: true,
        innerSize: '75%',
        data: [
            {
                name: 'Laki-laki',
                y: 40.0
            }, 
            {
                name: 'Perempuan',
                y: 50.9
            }, 
            {
                name: 'Anggota Remaja Masjid',
                y: 20.0
            }
        ]
    }]
});

// chart kemampuan baca
Highcharts.chart('chartKemampuanBaca', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Kemampuan Baca',
        align: 'center'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<span style="font-size: 1.2em"><b>{point.name}</b>' +
                    '</span><br>' +
                    '<span style="opacity: 0.6">{point.percentage:.1f} ' +
                    '%</span>',
                connectorColor: 'rgba(128,128,128,0.5)'
            },
            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        }
    },
    series: [{
        name: 'Jumlah warga',
        data: [
            { 
                name: 'Al-Quran', 
                y: 2055 
            },
            { 
                name: 'Iqra', 
                y: 8068 
            },
            { 
                name: 'Mengaji', 
                y: 4512 
            },
        ]
    }]
});
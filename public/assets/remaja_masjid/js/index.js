// chart jml remaja
// chart kemampuan baca
Highcharts.chart('jumlahRemaja', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Jumlah Remaja Masjid'
    },
    series: [{
        name: 'Jumlah',
        data: [
            { name: 'Laki-laki', y: window.jumlahRemajaLakiLaki, color:'#1366cd' },
            { name: 'Perempuan', y: window.jumlahRemajaPerempuan, color:'#cd14be' },
            { name: 'Anggota Remaja Masjid', y: window.jumlahAnggotaRemajaMasjid, color:'#faa924' }
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
        text: 'Kemampuan Baca Remaja',
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
                name: 'Baca Latin', 
                y: window.countBacaLatin ,
            },
            { 
                name: 'Baca Hijaiyah', 
                y: window.countBacaHijaiyah 
            },
            { 
                name: 'Baca Iqro', 
                y: window.countBacaIqro 
            },
            { 
                name: 'Baca Quran', 
                y: window.countBacaQuran 
            }
        ]
    }]
});

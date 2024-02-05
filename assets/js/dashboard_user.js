$(function () {


    // =====================================
    // Aperçu équipement user
    // =====================================
  
  
    var breakup = {
      color: "#adb5ff",
      series: [parseInt(document.getElementById('var_nbrelog').innerText), parseInt(document.getElementById('var_nbremat').innerText)],
      labels: ["Logiciels", "Matériels"],
      chart: {
        width: 400,
        type: "donut",
        fontFamily: "Plus Jakarta Sans', sans-serif",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          startAngle: 0,
          endAngle: 360,
          donut: {
            size: '0%',
          },
        },
      },
      stroke: {
        show: false,
      },
  
      dataLabels: {
        enabled: true,
      },
  
      legend: {
        show: true,
      },
      colors: ["#ffcc00","#5D87FF"],
  
      responsive: [
        {
          breakpoint: 991,
          options: {
            chart: {
              width: 250,
            },
          },
        },
      ],
      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };
  
    var chart = new ApexCharts(document.querySelector("#user_ae"), breakup);
    chart.render();
  
  
    
    // =====================================
    // Fréquence création de tickets
    // =====================================
  
    var data_freq_user = JSON.parse(document.getElementById('var_courbe_user').innerText);
    var earning = {
      chart: {
        id: "sparkline3",
        type: "area",
        height: 73,
        sparkline: {
          enabled: true,
        },
        group: "sparklines",
        fontFamily: "Plus Jakarta Sans', sans-serif",
        foreColor: "#adb0bb",
      },
      xaxis: {
        categories: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août", "Septembre", "Octobre", "Novembre", "Décembre"],
  
      },
      series: [
        {
          name: "Tickets crées",
          color: "#49BEFF",
          data: fillMissingMonths(data_freq_user),
        },
      ],
      stroke: {
        curve: "smooth",
        width: 2,
      },
      fill: {
        colors: ["#f3feff"],
        type: "solid",
        opacity: 0.05,
      },
  
      markers: {
        size: 0,
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: true,
          position: "right",
        },
        x: {
          show: true,
        },
      },
    };
    new ApexCharts(document.querySelector("#freq_t"), earning).render();
  
  
  
});
  function fillMissingMonths(data) {
    const result = Array.from({ length: 12 }, (_, i) => {
        const mois = (i + 1).toString();
        const entry = data.find(item => item.mois === mois);
        return entry ? parseInt(entry.nombre_tickets) : 0;
    });
  
    return result;
  }
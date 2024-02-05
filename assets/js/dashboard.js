$(function () {

  // =====================================
  // Admin : Vue entrés/sorties
  // =====================================


  var data_e_s = JSON.parse(document.getElementById('var_es').innerText);
  var monmax = Math.max(...fillEntreeMissingMonths(data_e_s), ...fillSortieMissingMonths(data_e_s)) + Math.max(...fillEntreeMissingMonths(data_e_s), ...fillSortieMissingMonths(data_e_s))%5;
  
  var chart = {
    series: [
      { name: "Entrés", data: fillEntreeMissingMonths(data_e_s) },
      { name: "Sorties", data: fillSortieMissingMonths(data_e_s) },
    ],

    chart: {
      type: "bar",
      height: 295,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },


    colors: ["#5D87FF", "#49BEFF"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },


    legend: {
      show: true,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août", "Septembre", "Octobre", "Novembre", "Décembre"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max:  monmax,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },


    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  var chart = new ApexCharts(document.querySelector("#chart_e_s"), chart);
  chart.render();



// =====================================
  // Admin: Aperçu équipement
  // =====================================

  var breakup = {
    color: "#adb5ff",
    series: [parseInt(document.getElementById('var_logass').innerText), parseInt(document.getElementById('var_logstock').innerText), parseInt(document.getElementById('var_matass').innerText), parseInt(document.getElementById('var_matstock').innerText), parseInt(document.getElementById('var_consommable').innerText), ],
    labels: ["Logiciels assignés", "Logiciels en stock", "Matériels assignés", "Matériels en stock", "Consommable en stock"],
    chart: {
      width: 450,
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
      enabled: false,
    },

    legend: {
      show: true,
    },
    colors: ["#3355FF","#79CEF9","#07CA2D","#61DE79","#EEF"],

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

  var chart = new ApexCharts(document.querySelector("#admin_ae"), breakup);
  chart.render();



  // =====================================
    // Fréquence création de tickets
    // =====================================
  
    var data_freq_user = JSON.parse(document.getElementById('var_courbe').innerText);
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
    new ApexCharts(document.querySelector("#freq_t_a"), earning).render();
  
  




})

function fillMissingMonths(data) {
  const result = Array.from({ length: 12 }, (_, i) => {
      const mois = (i + 1).toString();
      const entry = data.find(item => item.mois === mois);
      return entry ? parseInt(entry.nombre_tickets) : 0;
  });

  return result;
}

function fillEntreeMissingMonths(data) {
  const result = Array.from({ length: 12 }, (_, i) => {
    const mois = (i + 1).toString();
    const entry = data.find(item => item.mois === mois);
    return entry ? parseInt(entry.nb_entrees) : 0;
});

  return result;
}

function fillSortieMissingMonths(data) {
  const result = Array.from({ length: 12 }, (_, i) => {
    const mois = (i + 1).toString();
    const entry = data.find(item => item.mois === mois);
    return entry ? parseInt(entry.nb_sorties) : 0;
});


  return result;
}

function maxArrays(arr1, arr2) {
  if (arr1.length !== arr2.length) {
      throw new Error("Les tableaux doivent avoir la même longueur.");
  }
  console.log(arr1.map((element, index) => Math.max(element, arr2[index])));

  return (arr1.map((element, index) => Math.max(element, arr2[index])));
}


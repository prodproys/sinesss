// ---- 
// Archivo: highcharts.js
// Archivo Transpilado: work-panel/public/js/bundle.js
// Autor: Sinesss
// Tipo: Plantilla de Javascript
// Lenguaje: Javacript Ecmascript 6
// Descripción:  Este archivo tiene la programación de los gráficos, de la home y de la home de la base
// Usamos la librería externa :
// https://code.highcharts.com/highcharts.js
// la documentación de la librería externa es la siguiente :
// https://www.highcharts.com/docs/index
// ---- 
// 


const Highcharts_spanish={
  lang:{
    downloadCSV:"Descarga CSV",
    downloadJPEG:"Descarga JPEG image",
    downloadPDF:"Descarga PDF document",
    downloadPNG:"Descarga PNG image",
    downloadSVG:"Descarga SVG",
    downloadXLS:"Descarga XLS",
    exitFullscreen:"Salir de Vista Completa",
    viewFullscreen:"Ver en Vista Completa",
    printChart:"imprimir Gráfico"
  }
};
/*
######## ##     ## ######## ##     ## ########  ######
    ##    ##     ## ##       ###   ### ##       ##    ##
    ##    ##     ## ##       #### #### ##       ##
    ##    ######### ######   ## ### ## ######    ######
    ##    ##     ## ##       ##     ## ##             ##
    ##    ##     ## ##       ##     ## ##       ##    ##
    ##    ##     ## ######## ##     ## ########  ######
*/

const Highcharts_dark = {
  colors: [
      "#71a2b6",
      "#a7931b",
      "#f45b5b",
      "#7798BF",
      "#aaeeee",
      "#ff0066",
      "#eeaaee",
      "#55BF3B",
      "#DF5353",
      "#7798BF",
      "#aaeeee"
  ],
  chart: {
      backgroundColor: {
      linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
      stops: [
          [0, "#1f2532"],
          [1, "#000000"]
      ]
      },
      // style: {
      //     fontFamily: '\'Unica One\', sans-serif'
      // },
      plotBorderColor: "#606063"
  },
  title: {
      style: {
      color: "#E0E0E3",
      textTransform: "uppercase",
      fontSize: "20px"
      }
  },
  subtitle: {
      style: {
      color: "#E0E0E3",
      textTransform: "uppercase"
      }
  },
  xAxis: {
      gridLineColor: "#707073",
      labels: {
      style: {
          color: "#E0E0E3"
      }
      },
      lineColor: "#707073",
      minorGridLineColor: "#505053",
      tickColor: "#707073",
      title: {
      style: {
          color: "#A0A0A3"
      }
      }
  },
  yAxis: {
      gridLineColor: "#707073",
      labels: {
      style: {
          color: "#E0E0E3"
      }
      },
      lineColor: "#707073",
      minorGridLineColor: "#505053",
      tickColor: "#707073",
      tickWidth: 1,
      title: {
      style: {
          color: "#A0A0A3"
      }
      }
  },
  tooltip: {
      backgroundColor: "rgba(0, 0, 0, 0.85)",
      style: {
      color: "#F0F0F0"
      }
  },
  plotOptions: {
      series: {
      dataLabels: {
          color: "#F0F0F3",
          style: {
          fontSize: "13px"
          }
      },
      marker: {
          lineColor: "#333"
      }
      },
      boxplot: {
      fillColor: "#505053"
      },
      candlestick: {
      lineColor: "white"
      },
      errorbar: {
      color: "white"
      }
  },
  legend: {
      backgroundColor: "#000000",
      itemStyle: {
      color: "#E0E0E3"
      },
      itemHoverStyle: {
      color: "#FFF"
      },
      itemHiddenStyle: {
      color: "#606063"
      },
      title: {
      style: {
          color: "#C0C0C0"
      }
      }
  },
  credits: {
      style: {
      color: "#666"
      }
  },
  labels: {
      style: {
      color: "#707073"
      }
  },
  drilldown: {
      activeAxisLabelStyle: {
      color: "#F0F0F3"
      },
      activeDataLabelStyle: {
      color: "#F0F0F3"
      }
  },
  navigation: {
      buttonOptions: {
      symbolStroke: "#DDDDDD",
      theme: {
          fill: "#505053"
      }
      }
  },
  // scroll charts
  rangeSelector: {
      buttonTheme: {
      fill: "#505053",
      stroke: "#000000",
      style: {
          color: "#CCC"
      },
      states: {
          hover: {
          fill: "#707073",
          stroke: "#000000",
          style: {
              color: "white"
          }
          },
          select: {
          fill: "#000003",
          stroke: "#000000",
          style: {
              color: "white"
          }
          }
      }
      },
      inputBoxBorderColor: "#505053",
      inputStyle: {
      backgroundColor: "#333",
      color: "silver"
      },
      labelStyle: {
      color: "silver"
      }
  },
  navigator: {
      handles: {
      backgroundColor: "#666",
      borderColor: "#AAA"
      },
      outlineColor: "#CCC",
      maskFill: "rgba(255,255,255,0.1)",
      series: {
      color: "#7798BF",
      lineColor: "#A6C7ED"
      },
      xAxis: {
      gridLineColor: "#505053"
      }
  },
  scrollbar: {
      barBackgroundColor: "#808083",
      barBorderColor: "#808083",
      buttonArrowColor: "#CCC",
      buttonBackgroundColor: "#606063",
      buttonBorderColor: "#606063",
      rifleColor: "#FFF",
      trackBackgroundColor: "#404043",
      trackBorderColor: "#404043"
  }
};
const Highcharts_light = {
  colors: [
      "#19b0c2",
      "#8b7d63",
      "#8d4654",
      "#7798BF",
      "#aaeeee",
      "#ff0066",
      "#eeaaee",
      "#55BF3B",
      "#DF5353",
      "#7798BF",
      "#aaeeee"
  ],
  chart: {
      backgroundColor: null
      // style: {
      //   fontFamily: "'Unica One', sans-serif"
      // }
  },
  title: {
      style: {
      color: "black",
      fontSize: "16px",
      fontWeight: "bold"
      }
  },
  subtitle: {
      style: {
      color: "black"
      }
  },
  tooltip: {
      borderWidth: 0
  },
  labels: {
      style: {
      color: "#6e6e70"
      }
  },
  legend: {
      backgroundColor: "#E0E0E8",
      itemStyle: {
      fontWeight: "bold",
      fontSize: "13px",
      color: "#000000"
      }
  },
  xAxis: {
      labels: {
      style: {
          color: "#6e6e70"
      }
      }
  },
  yAxis: {
      labels: {
      style: {
          color: "#6e6e70"
      }
      }
  },
  plotOptions: {
      series: {
      shadow: true
      },
      candlestick: {
      lineColor: "#404048"
      },
      map: {
      shadow: false
      }
  },
  // Highstock specific
  navigator: {
      xAxis: {
      gridLineColor: "#D0D0D8"
      }
  },
  rangeSelector: {
      buttonTheme: {
      fill: "white",
      stroke: "#C0C0C8",
      "stroke-width": 1,
      states: {
          select: {
          fill: "#D0D0D8"
          }
      }
      }
  },
  scrollbar: {
      trackBorderColor: "#C0C0C8"
  }
};


window.addEventListener("load", () => {

  Highcharts.setOptions(theme == "dark" ? Highcharts_dark : Highcharts_light);

  Highcharts.setOptions(Highcharts_spanish);

  /*
  ##     ##  #######  ##     ## ########
  ##     ## ##     ## ###   ### ##
  ##     ## ##     ## #### #### ##
  ######### ##     ## ## ### ## ######
  ##     ## ##     ## ##     ## ##
  ##     ## ##     ## ##     ## ##
  ##     ##  #######  ##     ## ########
  */
  if (document.querySelectorAll(".page_dashboard").length > 0) {


    /*
     ######  ##     ##    ###    ########  ########       ##
    ##    ## ##     ##   ## ##   ##     ##    ##        ####
    ##       ##     ##  ##   ##  ##     ##    ##          ##
    ##       ######### ##     ## ########     ##          ##
    ##       ##     ## ######### ##   ##      ##          ##
    ##    ## ##     ## ##     ## ##    ##     ##          ##
     ######  ##     ## ##     ## ##     ##    ##        ######
    */

    let picture1_options = {
      chart: {
        type: "column"
      },
      title: {
        text: "Agremiados y aportantes al fondo CAEE"
      },
      subtitle: {
        text: "Proyección últimos meses"
      },
      xAxis: {
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: "Total de personas"
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
          '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      }
    };
    
    // DATA
    /*
    response.categories={
      categories:[
        "Ene 2017",
        "Feb 2017",
        "Mar 2017",
        "Abr 2017",
        "May 2017",
        "Jun 2017",
        "Jul 2017",
        "Ago 2017",
        "Sep 2017",
        "Oct 2017",
        "Nov 2017",
        "Dic 2017",
        "Ene 2018",
        "Feb 2018",
        "Mar 2018",
        "Abr 2018",
        "May 2018",
        "Jun 2018",
        "Jul 2018",
        "Ago 2018",
        "Sep 2018",
        "Oct 2018",
        "Nov 2018",
        "Dic 2018",
        "Ene 2019",
        "Feb 2019",
        "Mar 2019",
        "Abr 2019",
        "May 2019",
        "Jun 2019",
        "Jul 2019",
        "Ago 2019",
        "Sep 2019",
        "Oct 2019",
        "Nov 2019",
        "Dic 2019",
        "Ene 2020"
      ]
    };
    response.series= [
      {
        name: "Agremiados",
        data: [
          9063,
          9014,
          9070,
          9069,
          9099,
          9140,
          9186,
          9225,
          9232,
          9219,
          9272,
          9318,
          9321,
          9301,
          9344,
          9313,
          9290,
          9290,
          9306,
          9270,
          9285,
          9291,
          9316,
          9322,
          9330,
          9253,
          9217,
          9241,
          9162,
          9131,
          9171,
          9139,
          9280,
          9418,
          9397,
          9445,
          null
        ]
      },
      {
        name: "Agremiados aceptan CAEE",
        data: [
          5623,
          5867,
          5914,
          5684,
          5976,
          6075,
          6086,
          6135,
          6164,
          6192,
          6215,
          6276,
          6304,
          6313,
          6335,
          6335,
          6342,
          6372,
          6370,
          6383,
          6432,
          6476,
          6497,
          6543,
          6638,
          6460,
          6453,
          6474,
          6436,
          6436,
          6488,
          6485,
          6545,
          6625,
          6636,
          6668,
          null
        ]
      }
    ];
    */
    
    fetch(document.querySelector("#dashboard-image-1").dataset.url)
    .then( response => response.json() )
    .then( response => {

      picture1_options.xAxis.categories=response.categories;
      picture1_options.series=response.series;
      let picture1 = Highcharts.chart("dashboard-image-1", picture1_options);
      return;

    });
    /*
     ######  ##     ##    ###    ########  ########     #######
    ##    ## ##     ##   ## ##   ##     ##    ##       ##     ##
    ##       ##     ##  ##   ##  ##     ##    ##              ##
    ##       ######### ##     ## ########     ##        #######
    ##       ##     ## ######### ##   ##      ##       ##
    ##    ## ##     ## ##     ## ##    ##     ##       ##
     ######  ##     ## ##     ## ##     ##    ##       #########
    */
    let picture2_options = {
      chart: {
        type: "line"
      },
      title: {
        text: "Ingreso aportaciones regulares"
      },
      subtitle: {
        text: "Monto segregado por descuento directo y depósitos"
      },
      xAxis: { categories: {} },
      yAxis: {
        title: {
          text: "Monto ingresado"
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
          '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
      },
    };

    fetch(document.querySelector("#dashboard-image-2").dataset.url)
    .then( response => response.json() )
    .then( response => {

      picture2_options.xAxis.categories=response.categories;
      picture2_options.series=response.series;
      let picture2 = Highcharts.chart("dashboard-image-2", picture2_options);
      return;

    });




    /*
     ######  ##     ##    ###    ########  ########     #######
    ##    ## ##     ##   ## ##   ##     ##    ##       ##     ##
    ##       ##     ##  ##   ##  ##     ##    ##              ##
    ##       ######### ##     ## ########     ##        #######
    ##       ##     ## ######### ##   ##      ##              ##
    ##    ## ##     ## ##     ## ##    ##     ##       ##     ##
     ######  ##     ## ##     ## ##     ##    ##        #######
    */
    let picture3_options = {
      chart: {
        type: "line"
      },
      title: {
        text: "Ingreso fondo CAEE"
      },
      subtitle: {
        text: "Monto segregado por descuento directo y depósitos"
      },
      xAxis: { categories: {} },
      yAxis: {
        title: {
          text: "Monto ingresado"
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
          '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
      }
    };

    fetch(document.querySelector("#dashboard-image-3").dataset.url)
    .then( response => response.json() )
    .then( response => {

      picture3_options.xAxis.categories=response.categories;
      picture3_options.series=response.series;
      let picture3 = Highcharts.chart("dashboard-image-3", picture3_options);
      return;

    });   



   /*
      ########  #######   ######   ##       ########    ######## ##     ## ######## ##     ## ########
         ##    ##     ## ##    ##  ##       ##             ##    ##     ## ##       ###   ### ##
         ##    ##     ## ##        ##       ##             ##    ##     ## ##       #### #### ##
         ##    ##     ## ##   #### ##       ######         ##    ######### ######   ## ### ## ######
         ##    ##     ## ##    ##  ##       ##             ##    ##     ## ##       ##     ## ##
         ##    ##     ## ##    ##  ##       ##             ##    ##     ## ##       ##     ## ##
         ##     #######   ######   ######## ########       ##    ##     ## ######## ##     ## ########
   */
    const $links_toggle_theme = document.querySelectorAll(
      ".link_dark_mode a,.link_light_mode a"
    );

    $links_toggle_theme.forEach(element => {
      element.addEventListener("click", () => {
        Highcharts.setOptions(
          theme == "dark" ? Highcharts_dark : Highcharts_light
        );

        // picture1.update((theme == 'dark') ? Highcharts_dark : Highcharts_light);
        // picture2.update((theme == 'dark') ? Highcharts_dark : Highcharts_light);
        // picture3.update((theme == 'dark') ? Highcharts_dark : Highcharts_light);

        picture1 = Highcharts.chart("dashboard-image-1", picture1_options);
        picture2 = Highcharts.chart("dashboard-image-2", picture2_options);
        picture3 = Highcharts.chart("dashboard-image-3", picture3_options);
      });
    });


  }

  /*
  ########     ###     ######  ########
  ##     ##   ## ##   ##    ## ##
  ##     ##  ##   ##  ##       ##
  ########  ##     ##  ######  ######
  ##     ## #########       ## ##
  ##     ## ##     ## ##    ## ##
  ########  ##     ##  ######  ########
  */
  if (document.querySelectorAll(".modulo_settlements").length > 0) {


    const $link=document.getElementById('link-settlement_dashboard');
    $link.addEventListener("click", function () {
        
        fetch('ajax_page.php?page=controllers/controller_settlement_dashboard&id_settlement='+$link.dataset.item)
        
        .then( response =>  response.text()  )
        .then( responseText => {
            
            document.getElementById('inner_after').innerHTML=responseText;
 
          

            /*
             ######  ##     ##    ###    ########  ########       ##
            ##    ## ##     ##   ## ##   ##     ##    ##        ####
            ##       ##     ##  ##   ##  ##     ##    ##          ##
            ##       ######### ##     ## ########     ##          ##
            ##       ##     ## ######### ##   ##      ##          ##
            ##    ## ##     ## ##     ## ##    ##     ##          ##
             ######  ##     ## ##     ## ##     ##    ##        ######
            */
            let picture2_options = {
                chart: {
                type: "line"
                },
                title: {
                text: "Ingreso aportaciones regulares"
                },
                subtitle: {
                text: "Monto segregado por descuento directo y depósitos"
                },
                xAxis: {
                categories:{}
                },
                yAxis: {
                title: {
                    text: "Monto ingresado"
                }
                },
                tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat:
                    '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: "</table>",
                shared: true,
                useHTML: true
                },
            };
            
            fetch(document.querySelector("#dashboard-image-2").dataset.url)
            // fetch('ajax_page.php?page=controllers/controller_settlement-chart-1&id_settlement='+$link.dataset.item)
            .then( response => response.json() )
            .then( response => {
              
              console.log($link);

              picture2_options.xAxis.categories=response.categories;
              picture2_options.series=response.series;
              let picture2 = Highcharts.chart("dashboard-image-2", picture2_options);
              return;
        
            });  

            /*
             ######  ##     ##    ###    ########  ########     #######
            ##    ## ##     ##   ## ##   ##     ##    ##       ##     ##
            ##       ##     ##  ##   ##  ##     ##    ##              ##
            ##       ######### ##     ## ########     ##        #######
            ##       ##     ## ######### ##   ##      ##       ##
            ##    ## ##     ## ##     ## ##    ##     ##       ##
             ######  ##     ## ##     ## ##     ##    ##       #########
            */
            let picture3_options = {
                chart: {
                  type: "column"
                },
                title: {
                  text: "Agremiados y aportantes al fondo CAEE"
                },
                subtitle: {
                  text: "Proyección últimos meses"
                },
                xAxis: {
                  categories: [],
                  crosshair: true
                },
                yAxis: {
                  min: 0,
                  title: {
                    text: "Total de personas"
                  }
                },
                tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat:
                    '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                  footerFormat: "</table>",
                  shared: true,
                  useHTML: true
                },
                plotOptions: {
                  column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                  }
                },
                series: []
            };
            /*
            picture3_options.xAxis.categories=[
              "Ene 2017",
              "Feb 2017",
              "Mar 2017",
              "Abr 2017",
              "May 2017",
              "Jun 2017",
              "Jul 2017",
              "Ago 2017",
              "Sep 2017",
              "Oct 2017",
              "Nov 2017",
              "Dic 2017",
              "Ene 2018",
              "Feb 2018",
              "Mar 2018",
              "Abr 2018",
              "May 2018",
              "Jun 2018",
              "Jul 2018",
              "Ago 2018",
              "Sep 2018",
              "Oct 2018",
              "Nov 2018",
              "Dic 2018",
              "Ene 2019",
              "Feb 2019",
              "Mar 2019",
              "Abr 2019",
              "May 2019",
              "Jun 2019",
              "Jul 2019",
              "Ago 2019",
              "Sep 2019",
              "Oct 2019",
              "Nov 2019",
              "Dic 2019",
              "Ene 2020"
            ];
            picture3_options.series=[
              {
                name: "Agremiados",
                data: [
                  9063,
                  9014,
                  9070,
                  9069,
                  9099,
                  9140,
                  9186,
                  9225,
                  9232,
                  9219,
                  9272,
                  9318,
                  9321,
                  9301,
                  9344,
                  9313,
                  9290,
                  9290,
                  9306,
                  9270,
                  9285,
                  9291,
                  9316,
                  9322,
                  9330,
                  9253,
                  9217,
                  9241,
                  9162,
                  9131,
                  9171,
                  9139,
                  9280,
                  9418,
                  9397,
                  9445,
                  null
                ]
              },
              {
                name: "Agremiados aceptan CAEE",
                data: [
                  5623,
                  5867,
                  5914,
                  5684,
                  5976,
                  6075,
                  6086,
                  6135,
                  6164,
                  6192,
                  6215,
                  6276,
                  6304,
                  6313,
                  6335,
                  6335,
                  6342,
                  6372,
                  6370,
                  6383,
                  6432,
                  6476,
                  6497,
                  6543,
                  6638,
                  6460,
                  6453,
                  6474,
                  6436,
                  6436,
                  6488,
                  6485,
                  6545,
                  6625,
                  6636,
                  6668,
                  null
                ]
              }
            ];
            */

    
            fetch(document.querySelector("#dashboard-image-3").dataset.url)
            // fetch('ajax_page.php?page=controllers/controller_settlement-chart-1&id_settlement='+$link.dataset.item)
            .then( response => response.json() )
            .then( response => {
        
              picture3_options.xAxis.categories=response.categories;
              picture3_options.series=response.series;

              let picture3 = Highcharts.chart("dashboard-image-3", picture3_options);
              return;
        
            });        


            const $links_toggle_theme = document.querySelectorAll(
                ".link_dark_mode a,.link_light_mode a"
            );
        
            $links_toggle_theme.forEach(element => {
                element.addEventListener("click", () => {
                Highcharts.setOptions(
                    theme == "dark" ? Highcharts_dark : Highcharts_light
                );

                picture2 = Highcharts.chart("dashboard-image-2", picture2_options);
                picture3 = Highcharts.chart("dashboard-image-3", picture3_options);
                });
            });

            return;

        })
        .catch((fallo)=>{

            console.log('me fallaste');
            
        });

        // $menuDetailSubLink[0].scrollIntoView({ behavior: 'smooth', block: 'start' });

    });

  }


});

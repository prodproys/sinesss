const loadPageByURLButtom = (url, where) => {
  document.getElementById("refresh").style.display = "block";
  document.getElementById("refresh-cover").style.display = "block";

  new Request({
    url: url,
    method: "get",
    onSuccess: function (ee) {
      document.getElementById(where).innerHTML = ee;
      document.getElementById("refresh").style.display = "none";
      document.getElementById("refresh-cover").style.display = "none";
    }
  }).send();
};

function releaseClick(selector){
  let $button = document.querySelector(selector);
  $button.click();
}

function $v(a) {
  let aa=document.getElementById(a);
  if(typeof(aa)=='undefined'){ console.error("ne "+a); return false; }
  return aa.value;
}
function $1(a) {
  document.getElementById(a).style.display='';
}
function $0(a) {
  // console.log('0:' + a);
  document.getElementById(a).style.display='none';
}
function $H(a, val) {
  document.getElementById(a).innerHTML = val;
}

function opcl(cls) {
  $$(".ul_menus .opcl").each(function (div) {
    div.removeClass("open");
  });
  $(cls).addClass("open");
}

function pop_up(url) {
  setTimeout("pop_up0('" + url + "')", "4000");
}
function pop_up0(url) {
  beforemulti();

  var clicked = new Element("a", {
    styles: {
      position: "absolute",
      top: 0,
      left: 0,
      width: "1px",
      height: "1px",
      visibility: "hidden"
    },
    href: url,
    class: "mb",
    rel: "width:1000,height:500",
    html: "&nbsp"
  }).inject(document.body, "bottom");
  var initMultiBox = new multiBox({
    mbClass: ".mb", //class you need to add links that you want to trigger multiBox with (remember and update CSS files)
    container: $(document.body), //where to inject multiBox
    descClassName: "multiBoxDesc", //the class name of the description divs
    path: "./Files/", //path to mp3 and flv players
    useOverlay: false, //use a semi-transparent background. default             : false;
    maxSize: { w: 1000, h: 500 }, //max dimensions (width,height) - set to null to disable resizing
    addDownload: false, //do you want the files to be downloadable?
    pathToDownloadScript: "./Scripts/ForceDownload.asp", //if above is true, specify path to download script (classicASP and ASP.NET versions included)
    addRollover: false, //add rollover fade to each multibox link
    addOverlayIcon: false, //adds overlay icons to images within multibox links
    addChain: false, //cycle through all images fading them out then in
    recalcTop: true, //subtract the height of controls panel from top position
    addTips: false //adds MooTools built in 'Tips' class to each element (see: http   : //mootools.net/docs/Plugins/Tips)
  });
  clicked.click();
}

function fechaChange(input) {
  var aa = $(input + "_a").value;
  var mm = $(input + "_m").value;
  var dd = $(input + "_d").value;
  var tt = $(input + "_t").value;
  var time =
    aa == "" || mm == "" || dd == ""
      ? ""
      : aa + "-" + mm + "-" + dd + " " + (tt == "" ? "00:00:00" : tt);
  $(input).value = time;
}

function input_date(id_input, id_span, fromYear, toYear, sethoras, justmonth) {
  var meses = new Array();
  var horas = new Array();
  var horas2 = new Array();

  meses[1] = "Ene";
  meses[2] = "Feb";
  meses[3] = "Mar";
  meses[4] = "Abr";
  meses[5] = "May";
  meses[6] = "Jun";
  meses[7] = "Jul";
  meses[8] = "Ago";
  meses[9] = "Set";
  meses[10] = "Oct";
  meses[11] = "Nov";
  meses[12] = "Dic";

  horas[0] = "12am";
  horas[1] = "1am";
  horas[2] = "2am";
  horas[3] = "3am";
  horas[4] = "4am";
  horas[5] = "5am";
  horas[6] = "6am";
  horas[7] = "7am";
  horas[8] = "8am";
  horas[9] = "9am";
  horas[10] = "10am";
  horas[11] = "11am";
  horas[12] = "12pm";
  horas[13] = "1pm";
  horas[14] = "2pm";
  horas[15] = "3pm";
  horas[16] = "4pm";
  horas[17] = "5pm";
  horas[18] = "6pm";
  horas[19] = "7pm";
  horas[20] = "8pm";
  horas[21] = "9pm";
  horas[22] = "10pm";
  horas[23] = "11pm";

  horas2[0] = "12:00am";
  horas2[1] = "12:15am";
  horas2[2] = "12:30am";
  horas2[3] = "12:45am";
  horas2[4] = "1:00am";
  horas2[5] = "1:15am";
  horas2[6] = "1:30am";
  horas2[7] = "1:45am";
  horas2[8] = "2:00am";
  horas2[9] = "2:15am";
  horas2[10] = "2:30am";
  horas2[11] = "2:45am";
  horas2[12] = "3:00am";
  horas2[13] = "3:15am";
  horas2[14] = "3:30am";
  horas2[15] = "3:45am";
  horas2[16] = "4:00am";
  horas2[17] = "4:15am";
  horas2[18] = "4:30am";
  horas2[19] = "4:45am";
  horas2[20] = "5:00am";
  horas2[21] = "5:15am";
  horas2[22] = "5:30am";
  horas2[23] = "5:45am";
  horas2[24] = "6:00am";
  horas2[25] = "6:15am";
  horas2[26] = "6:30am";
  horas2[27] = "6:45am";
  horas2[28] = "7:00am";
  horas2[29] = "7:15am";
  horas2[30] = "7:30am";
  horas2[31] = "7:45am";
  horas2[32] = "8:00am";
  horas2[33] = "8:15am";
  horas2[34] = "8:30am";
  horas2[35] = "8:45am";
  horas2[36] = "9:00am";
  horas2[37] = "9:15am";
  horas2[38] = "9:30am";
  horas2[39] = "9:45am";
  horas2[40] = "10:00am";
  horas2[41] = "10:15am";
  horas2[42] = "10:30am";
  horas2[43] = "10:45am";
  horas2[44] = "11:00am";
  horas2[45] = "11:15am";
  horas2[46] = "11:30am";
  horas2[47] = "11:45am";
  horas2[48] = "12:00pm";
  horas2[49] = "12:15pm";
  horas2[50] = "12:30pm";
  horas2[51] = "12:45pm";
  horas2[52] = "1:00pm";
  horas2[53] = "1:15pm";
  horas2[54] = "1:30pm";
  horas2[55] = "1:45pm";
  horas2[56] = "2:00pm";
  horas2[57] = "2:15pm";
  horas2[58] = "2:30pm";
  horas2[59] = "2:45pm";
  horas2[60] = "3:00pm";
  horas2[61] = "3:15pm";
  horas2[62] = "3:30pm";
  horas2[63] = "3:45pm";
  horas2[64] = "4:00pm";
  horas2[65] = "4:15pm";
  horas2[66] = "4:30pm";
  horas2[67] = "4:45pm";
  horas2[68] = "5:00pm";
  horas2[69] = "5:15pm";
  horas2[70] = "5:30pm";
  horas2[71] = "5:45pm";
  horas2[72] = "6:00pm";
  horas2[73] = "6:15pm";
  horas2[74] = "6:30pm";
  horas2[75] = "6:45pm";
  horas2[76] = "7:00pm";
  horas2[77] = "7:15pm";
  horas2[78] = "7:30pm";
  horas2[79] = "7:45pm";
  horas2[80] = "8:00pm";
  horas2[81] = "8:15pm";
  horas2[82] = "8:30pm";
  horas2[83] = "8:45pm";
  horas2[84] = "9:00pm";
  horas2[85] = "9:15pm";
  horas2[86] = "9:30pm";
  horas2[87] = "9:45pm";
  horas2[88] = "10:00pm";
  horas2[89] = "10:15pm";
  horas2[90] = "10:30pm";
  horas2[91] = "10:45pm";
  horas2[92] = "11:00pm";
  horas2[93] = "11:15pm";
  horas2[94] = "11:30pm";
  horas2[95] = "11:45pm";

  var html = "";

  if (justmonth == "1") {
    html += "<input id='" + id_input + "_d' type='hidden' value='01' />";
  } else {
    html +=
      "<select id='" +
      id_input +
      "_d' class='form_input form_input_fecha' onchange='fechaChange(\"" +
      id_input +
      "\")'>";
    html += "<option></option>";
    for (var i = 1; i <= 31; i++) {
      html +=
        "<option value='" + (i < 10 ? "0" + i : i) + "'>" + i + "</option>";
    }
    html += "</select>";
  }

  html +=
    "<select id='" +
    id_input +
    "_m' class='form_input form_input_fecha' onchange='fechaChange(\"" +
    id_input +
    "\")'>";

  html += "<option></option>";
  for (var i = 1; i <= 12; i++) {
    html +=
      "<option value='" +
      (i < 10 ? "0" + i : i) +
      "'>" +
      meses[i] +
      "</option>";
  }
  html += "</select>";

  html +=
    "<select id='" +
    id_input +
    "_a' class='form_input form_input_fecha' onchange='fechaChange(\"" +
    id_input +
    "\")'>";

  html += "<option></option>";
  for (var i = toYear; i >= fromYear; i--) {
    html += "<option value='" + i + "'>" + i + "</option>";
  }
  html += "</select>";

  if (sethoras == "1") {
    html +=
      "<select id='" +
      id_input +
      "_t' class='form_input form_input_fecha' onchange='fechaChange(\"" +
      id_input +
      "\")'>";
    html += "<option></option>";
    for (var i = 0; i < 24; i++) {
      html +=
        "<option value='" +
        (i < 10 ? "0" + i : i) +
        ":00:00'>" +
        horas[i] +
        "</option>";
    }
    html += "</select>";
  } else if (sethoras == "2") {
    var iii = 0;
    html +=
      "<select id='" +
      id_input +
      "_t' class='form_input form_input_fecha' onchange='fechaChange(\"" +
      id_input +
      "\")'>";
    html += "<option></option>";
    for (var i = 0; i < 24; i++) {
      for (var i2 = 0; i2 < 4; i2++) {
        html +=
          "<option value='" +
          (i < 10 ? "0" + i : i) +
          ":" +
          (i2 * 15 < 10 ? "0" + i2 * 15 : i2 * 15) +
          ":00'>" +
          horas2[iii++] +
          "</option>";
      }
    }
    html += "</select>";
  } else {
    html += "<input id='" + id_input + "_t' type='hidden' />";
  }

  html += "<input id='" + id_input + "' type='hidden' />";

  $(id_span).innerHTML = html;
}

/*
function fechaChangeFilterRP(input){
	input=input.replace("fs_","");
	var aa0=$('from_fs_'+input+'_a').value;
	var mm0=$('from_fs_'+input+'_m').value;
	var dd0=$('from_fs_'+input+'_d').value;
	var aa1=$('to_fs_'+input+'_a').value;
	var mm1=$('to_fs_'+input+'_m').value;
	var dd1=$('to_fs_'+input+'_d').value;
	var time=(aa0==''||mm0==''||dd0==''||aa1==''||mm1==''||dd1=='')?'':input+"|"+aa0+"-"+mm0+"-"+dd0+"|"+aa1+"-"+mm1+"-"+dd1;
	$('filtr_fs_'+input).value=time;
	render_filderRP(input);
}*/

function fechaChangeFilterST(input) {
  input = input.replace("fs_", "");
  var aa0 = $("from_fs_" + input + "_a").value;
  var mm0 = $("from_fs_" + input + "_m").value;
  var dd0 = $("from_fs_" + input + "_d").value;
  var aa1 = $("to_fs_" + input + "_a").value;
  var mm1 = $("to_fs_" + input + "_m").value;
  var dd1 = $("to_fs_" + input + "_d").value;
  // var time=(aa0==''||mm0==''||dd0==''||aa1==''||mm1==''||dd1=='')?'':input+"|"+aa0+"-"+mm0+"-"+dd0+"|"+aa1+"-"+mm1+"-"+dd1;
  var time =
    aa0 == "" || mm0 == "" || dd0 == "" || aa1 == "" || mm1 == "" || dd1 == ""
      ? ""
      : aa0 + "-" + mm0 + "-" + dd0 + "|" + aa1 + "-" + mm1 + "-" + dd1;
  $("filtr_fs_" + input).value = time;
  render_filderST(input);
}

function render_filderRP(input, dis) {

  var file = "";

  var vurl = "";

  var campos;

  if ($(dis) != null) campos = $(dis).dataset.campos;

  $$(".stfilters").each(function (ee) {
    if ($(ee).getProperty("id") == undefined) {
      // alert( 'filtr_fs_'+input );
      vurl +=
        "&" +
        $(ee).getProperty("rel") +
        "=" +
        $("filtr_fs_" + $(ee).getProperty("rel")).value;
    } else {
      vurl += "&" + $(ee).getProperty("rel") + "=" + $(ee).value;
      // alert('&'+$(ee).getProperty('rel')+'='+$(ee).value);
    }
  });

  // if($('filtr_fs_'+input)){ vurl+=$('filtr_fs_'+input).value; }
  $$(".option_report_file").each(function (ee) {
    if ($(ee).checked) {
      file = $(ee).value;
    }
  });

  if (file == "") return;

  vurl = "file=" + file + vurl;

  vurl = "load_html_reportes.php?" + vurl;
  
  $$(".repo_fils").setStyles({ display: "none" });

  var camps = new Array();

  if (typeof campos != "undefined") {
    camps = campos.split(",");
    camps.each(function (ele) {
      // console.log(ele);
      if ($("repo_fil_" + ele) != null)
        $("repo_fil_" + ele).setStyles({ display: "inline-block" });
    });
  }

  $("html_reporte").innerHTML =
    '<div class="refreshing"><b>cargando reporte....</b></div>';

  new Request({
    url: vurl,
    method: "get",
    evalScripts: true,
    onSuccess: function (ee) {
      $("html_reporte").innerHTML = ee;
      var labells = document.labelforms.report_file;
      // console.log(labells.length);
      for (i = 0; i < labells.length; i++) {
        if (labells[i].checked == true) {
          // console.log(labells[i]);
          // labells[i].click();
          var campos = labells[i].dataset.campos;
          // console.log(campos);
          if (typeof campos != "undefined") {
            camps = campos.split(",");
            camps.each(function (ele) {
              // console.log(ele);
              if ($("repo_fil_" + ele) != null)
                $("repo_fil_" + ele).setStyles({ display: "inline-block" });
            });
          }
        }
      }
      // if(typeof('load_reporte_'+file)=='function') eval('reporte_'+file);
    }
  }).send();
}

function render_filderST(input) {
  if (!$("obfs")) render_filderRP(input);
  return;

  var url = "b=";
  var vurl;
  url += "" + $("obfs").value;
  url += "|" + $("filtr_fs_orderby").value + "|";
  if ($("filtr_fs_" + input)) {
    url += $("filtr_fs_" + input).value;
  }
  vurl = url;
  // url="load_estadistica.php?"+url;
  // swfobject.embedSWF("js/open-flash-chart.swf", "my_chart","550", "380", "9.0.0", "expressInstall.swf",{"data-file":url} );
  load_html_estadistica(vurl);
}

function load_html_estadistica(vurl) {
  new Request({
    url: "load_html_estadistica.php?" + vurl,
    method: "get",
    onSuccess: function (ee) {
      $("load_html_estadistica").innerHTML = ee;
    }
  }).send();
}
function input_date_filtro(id_input, id_span, fromYear, toYear) {
  var meses = new Array();

  meses[1] = "Ene";
  meses[2] = "Feb";
  meses[3] = "Mar";
  meses[4] = "Abr";
  meses[5] = "May";
  meses[6] = "Jun";
  meses[7] = "Jul";
  meses[8] = "Ago";
  meses[9] = "Set";
  meses[10] = "Oct";
  meses[11] = "Nov";
  meses[12] = "Dic";

  var html = "";
  html += "<span class='filfchspan'>Desde</span>";
  html +=
    "<select id='from_" +
    id_input +
    "_d' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = 1; i <= 31; i++) {
    html += "<option value='" + (i < 10 ? "0" + i : i) + "'>" + i + "</option>";
  }
  html += "</select>";
  html +=
    "<select id='from_" +
    id_input +
    "_m' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = 1; i <= 12; i++) {
    html +=
      "<option value='" +
      (i < 10 ? "0" + i : i) +
      "'>" +
      meses[i] +
      "</option>";
  }
  html += "</select>";
  html +=
    "<select id='from_" +
    id_input +
    "_a' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = toYear; i >= fromYear; i--) {
    html += "<option value='" + i + "'>" + i + "</option>";
  }
  html += "</select>";
  html += "<span class='filfchspan'>Hasta</span>";
  html +=
    "<select id='to_" +
    id_input +
    "_d' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = 1; i <= 31; i++) {
    html += "<option value='" + (i < 10 ? "0" + i : i) + "'>" + i + "</option>";
  }
  html += "</select>";
  html +=
    "<select id='to_" +
    id_input +
    "_m' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = 1; i <= 12; i++) {
    html +=
      "<option value='" +
      (i < 10 ? "0" + i : i) +
      "'>" +
      meses[i] +
      "</option>";
  }
  html += "</select>";
  html +=
    "<select id='to_" +
    id_input +
    "_a' class='form_input form_input_fecha' onchange='fechaChangeFilter(\"" +
    id_input +
    "\")'>";
  html += "<option></option>";
  for (var i = toYear; i >= fromYear; i--) {
    html += "<option value='" + i + "'>" + i + "</option>";
  }
  html += "</select>";
  html +=
    "<input id='filtr_" + id_input + "' type='hidden' style='width:400px;' />";

  $(id_span).innerHTML = html;
}

function fechaChangeFilter(input,inner,me,getid) {
  var aa0 = $("from_" + input + "_a").value;
  var mm0 = $("from_" + input + "_m").value;
  var dd0 = $("from_" + input + "_d").value;
  var aa1 = $("to_" + input + "_a").value;
  var mm1 = $("to_" + input + "_m").value;
  var dd1 = $("to_" + input + "_d").value;
  //var time=(aa0==''||mm0==''||dd0==''||aa1==''||mm1==''||dd1=='')?'':"date("+input+") between '"+aa0+"-"+mm0+"-"+dd0+"' and '"+aa1+"-"+mm1+"-"+dd1+"'";
  var time =
    aa0 == "" || mm0 == "" || dd0 == "" || aa1 == "" || mm1 == "" || dd1 == ""
      ? ""
      : input +
        "|" +
        aa0 +
        "-" +
        mm0 +
        "-" +
        dd0 +
        "|" +
        aa1 +
        "-" +
        mm1 +
        "-" +
        dd1;

  //time=encodeURIComponent(time);
  $("filtr_" + input).value = time;
  render_filder(inner,me,getid);
}
function betweenST(campo, query) {
  var q0 = new Array();
  var q1 = new Array();
  var q2 = new Array();
  q0 = query.split("|");
  q1 = q0[0].split("-");
  q2 = q0[1].split("-");
  $("from_fs_" + campo + "_d").value = q1[2];
  $("from_fs_" + campo + "_m").value = q1[1];
  $("from_fs_" + campo + "_a").value = q1[0];
  $("to_fs_" + campo + "_d").value = q2[2];
  $("to_fs_" + campo + "_m").value = q2[1];
  $("to_fs_" + campo + "_a").value = q2[0];
}
function between(campo, query) {
  var q0 = new Array();
  var q1 = new Array();
  var q2 = new Array();
  q0 = query.split("|");
  q1 = q0[0].split("-");
  q2 = q0[1].split("-");
  $("from_" + campo + "_d").value = q1[2];
  $("from_" + campo + "_m").value = q1[1];
  $("from_" + campo + "_a").value = q1[0];
  $("to_" + campo + "_d").value = q2[2];
  $("to_" + campo + "_m").value = q2[1];
  $("to_" + campo + "_a").value = q2[0];
}
function cargar_combo(span, sql, value) {
  if ($(span + "_load_combo"))
    $(span + "_load_combo").innerHTML =
      '<option style="color:#CCC;">&nbsp;&nbsp;&nbsp;cargando opciones...</option>';
  new Request({
    url:
      "cargar_combo.php?obj=" +
      MMEE +
      "&s=" +
      sql.replace("=", "") +
      "&s2=" +
      value +
      "&camp=" +
      span,
    method: "get",
    onSuccess: function (ee) {
      if ($(span + "_load_combo")) $(span + "_load_combo").innerHTML = ee;
    }
  }).send();
}
function load_combo(span, sql, value, after) {
  // alert(span);
  // alert(sql);
  // alert(value);
  if (!$("in_" + span)) return;
  $("in_" + span).innerHTML = "";
  new Element("option", { value: "", html: "............." }).inject(
    $("in_" + span),
    "bottom"
  );
  new Request({
    url:
      "load_combo.php?s=" +
      encodeURIComponent(sql) +
      "&s2=" +
      value +
      "&camp=" +
      span,
    method: "get",
    onSuccess: function (ee) {
      var json = JSON.decode(ee, true);
      $("in_" + span).innerHTML = "";
      new Element("option", { value: "", html: "" }).inject(
        $("in_" + span),
        "bottom"
      );
      for (var i = 0; i < json.length; i++) {
        new Element("option", {
          value: json[i][0],
          html: json[i][1]
        }).inject($("in_" + span), "bottom");
      }
      $("in_" + span).value = $("in_" + span).rel;
      if (after != null) eval(after);
    }
  }).send();
}
function load_htmls(sql, value, after) {
  new Request({
    url: "load_datos.php?s=" + encodeURIComponent(sql) + "&s2=" + value,
    method: "get",
    onSuccess: function (ee) {
      var json = JSON.decode(ee, true);
      Object.each(json, function (value, key) {
        eval("CKEDITOR.instances.in_" + key + ".setData(value)");
      }); // eval(value+"()");
    }
  }).send();
}
function load_checks(sql, value, after) {
  new Request({
    url: "load_datos.php?s=" + encodeURIComponent(sql) + "&s2=" + value,
    method: "get",
    onSuccess: function (ee) {
      var json = JSON.decode(ee, true);
      Object.each(json, function (value, key) {
        $("in_" + key).value = value;
        if ($("in_" + key).value == 1) $("in_" + key + "_check").checked = true;
      });
      eval(after);
      // eval(value+"()");
    }
  }).send();
}
function load_datos(sql, value, after) {
  // alert(sql);
  // alert(value);
  // alert(after);
  new Request({
    url: "load_datos.php?s=" + encodeURIComponent(sql) + "&s2=" + value,
    method: "get",
    onSuccess: function (ee) {
      var json = JSON.decode(ee, true);
      Object.each(json, function (value, key) {
        $("in_" + key).value = value;
      });
      //alert(after);
      eval(after);
      // eval(value+"()");
    }
  }).send();
}
function load_datos_fecha(sql, value) {
  new Request({
    url: "load_datos.php?s=" + encodeURIComponent(sql) + "&s2=" + value,
    method: "get",
    onSuccess: function (ee) {
      var json = JSON.decode(ee, true);
      Object.each(json, function (value, key) {
        $("in_" + key).value = value;
        $("in_" + key + "_d").value = value.substring(8, 10);
        $("in_" + key + "_m").value = value.substring(5, 7);
        $("in_" + key + "_a").value = value.substring(0, 4);
      });
    }
  }).send();
}

function cargar_combo2(span, sql, value, tab) {
  var opc;
  new Request({
    url:
      "cargar_combo.php?obj=" +
      MMEE +
      "&s=" +
      sql.replace("=", "") +
      "&s2=" +
      value +
      "&camp=" +
      span,
    method: "get",
    onSuccess: function (ee) {
      $(span + "_load_combo").innerHTML = ee;
      opc = $(span + "_load_combo").getProperty("title");
      $(span + "_load_combo").removeProperty("title");
      $("in_" + span).value = opc;
    }
  }).send();
}

function abrir_mass(set, save) {
  if ($("titulo_mass")) {
    if (set == "1") {
      $("bloque_content_mass").setStyles({ display: "" });
      //$('inner').setStyles({'display':'none'});
      //load_crear();
      //ax('resetear');
    } else {
      $("bloque_content_mass").setStyles({ display: "none" });
      //$('inner').setStyles({'display':''});
    }
  } else {
    load_mass();
    //$('inner').setStyles({'display':'none'});
  }
  if ($("abrir_mass")) {
    $0((set == 1 ? "abrir" : "cerrar") + "_mass");
    $1((set == 1 ? "cerrar" : "abrir") + "_mass");
  }
}

function abrir_crear(set, save) {
  if ($("titulo_crear")) {
    if (set == "1") {
      $("bloque_content_crear").setStyles({ display: "" });
      $("inner").setStyles({ display: "none" });
      // $('segunda_barra_2').setStyles({'display':'none'});
      //load_crear();
      ax("resetear");
    } else {
      $("bloque_content_crear").setStyles({ display: "none" });
      $("inner").setStyles({ display: "" });
      // $('segunda_barra_2').setStyles({'display':''});
    }
  } else {
    // alert('1');
    load_crear();
    // alert('2');
    $("inner").setStyles({ display: "none" });
    // $('segunda_barra_2').setStyles({'display':'none'});
  }
  if ($("abrir_crear")) {
    $0((set == 1 ? "abrir" : "cerrar") + "_crear");
    $1((set == 1 ? "cerrar" : "abrir") + "_crear");
  }
}

function abrir_stat(set, save) {
  if ($("titulo_stat")) {
    if (set == "1") {
      $("bloque_content_stat").setStyles({ display: "" });
      $("inner").setStyles({ display: "none" });
      // $('segunda_barra_2').setStyles({'display':'none'});
      //load_crear();
    } else {
      $("bloque_content_stat").setStyles({ display: "none" });
      $("inner").setStyles({ display: "" });
      // $('segunda_barra_2').setStyles({'display':''});
    }
    //alert('resetear');
    //ax('resetear');
  } else {
    //
    load_stat();
    $("inner").setStyles({ display: "none" });
    // $('segunda_barra_2').setStyles({'display':'none'});
    //alert('load_crear');
  }
  if ($("abrir_stat")) {
    $0((set == 1 ? "abrir" : "cerrar") + "_stat");
    $1((set == 1 ? "cerrar" : "abrir") + "_stat");
  }
}

function abrir_repos(set, save) {
  if ($("titulo_repos")) {
    if (set == "1") {
      $("bloque_content_repos").setStyles({ display: "" });
      $("inner").setStyles({ display: "none" });
      $('inner_after').setStyles({'display':'none'});
      // $('segunda_barra_2').setStyles({'display':'none'});
      $("boton_excel").setStyles({ display: "none" });
      $("boton_imprimir").setStyles({ display: "none" });

      //load_crear();
    } else {
      $("bloque_content_repos").setStyles({ display: "none" });
      $("inner").setStyles({ display: "" });
      $('inner_after').setStyles({'display':''});
      // $('segunda_barra_2').setStyles({'display':''});
      $("boton_excel").setStyles({ display: "" });
      $("boton_imprimir").setStyles({ display: "" });

    }
    //alert('resetear');
    //ax('resetear');
  } else {
    //
    load_repos();
    $("inner").setStyles({ display: "none" });
    $('inner_after').setStyles({'display':'none'});

    // $('segunda_barra_2').setStyles({'display':'none'});
    if ($("boton_excel")) $("boton_excel").setStyles({ display: "none" });
    if ($("boton_imprimir")) $("boton_imprimir").setStyles({ display: "none" });


    //alert('load_crear');
  }
  if ($("abrir_repos")) {

    $0((set == 1 ? "abrir" : "cerrar") + "_repos");
    $1((set == 1 ? "cerrar" : "abrir") + "_repos");
  }
}

/* Javascript de upload de imagen */

function eliminar_img_foto(tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $1("image_" + camp + "_default");
  $("image_" + camp + "_img").src = USU_IMG_DEFAULT;
  $("form_" + camp).reset();
  $0("image_" + camp + "_img_cerrar");
  $("upload_in_" + camp).value = "eliminar";
}
function eliminar_img_sto(tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $1("image_" + camp + "_default");
  $("image_" + camp + "_img").src = USU_IMG_DEFAULT;
  $("form_" + camp).reset();
  $0("image_" + camp + "_img_cerrar");
  $("upload_in_" + camp).value = "eliminar";
}
function reset_img_foto(tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $1("image_" + camp + "_default");
  $("image_" + camp + "_img").src = $("image_" + camp + "_temp").value;
  $("form_" + camp).reset();
  $0("image_" + camp + "_img_cerrar");
  $("upload_in_" + camp).value = "";
}

function reset_img_sto(tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $("txt_" + camp + "_name").innerHTML = "";
  //$1('image_'+camp+'_default');	alert(4);
  //$('image_'+camp+'_img').src=$('image_'+camp+'_temp').value;	alert(5);
  $("form_" + camp).reset();
  $0("image_" + camp + "_img_cerrar");
  $("upload_in_" + camp).value = "";
}

function upload(tab, camp) {
  $1("image_" + camp + "_controles1");
  $1("image_" + camp + "_copiando");
  $0("image_" + camp + "_default");
  $("form_" + camp).submit();
  $("error_" + camp).innerHTML = "";
}

function upload_sto(tab, camp) {
  $1("image_" + camp + "_controles1");
  $1("image_" + camp + "_copiando");
  $("form_" + camp).submit();
  $("error_" + camp).innerHTML = "";
}

function upload_err(m, tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $1("image_" + camp + "_default");
  $("error_" + camp).innerHTML = m;
  $("form_" + camp).reset();
}

function upload_err_sto(m, tab, camp) {
  $1("image_" + camp + "_controles1");
  $0("image_" + camp + "_copiando");
  $("error_" + camp).innerHTML = m;
  $("form_" + camp).reset();
}

function upload_terminar_sto(i, tab, camp, name) {
  $0("image_" + camp + "_copiando");
  $("error_" + camp).innerHTML = "";
  $("upload_in_" + camp).value = i;
  $("txt_" + camp + "_name").innerHTML = name;
  $0("image_" + camp + "_controles1");
  $1("image_" + camp + "_img_cerrar");
}

function upload_terminar(i, tab, camp, resized, crear_quick) {
  //alert('error_'+camp);
  $("error_" + camp).innerHTML = "";
  //alert('image_'+camp+'_img');
  $("image_" + camp + "_img").src = i;
  if (resized != null) {
    if (resized == true) {
      //alert('image_'+camp+'_img');
      $("image_" + camp + "_img").width = "100";
    }
  }
  $("upload_in_" + camp).value = i; //alert(6);
  $0("image_" + camp + "_controles1"); //alert(7);
  $1("image_" + camp + "_img_cerrar"); //alert(8);
  if (crear_quick == 1) {
    ax("insertar", "");
  } else {
    //alert('image_'+camp+'_copiando');
    $0("image_" + camp + "_copiando");
    //alert('image_'+camp+'_default');
    $1("image_" + camp + "_default");
  }
}

function render_upload(tb, campo, id, img_default, il) {
  var id2 = id == "" ? "" : "_" + id;
  var html = '<div class="divupl">';
  if (img_default != USU_IMG_DEFAULT) {
    html +=
      '<a class="elim" onclick="eliminar_img_foto(\'' +
      tb +
      "','" +
      campo +
      id2 +
      '\');return false;"  title="eliminar imágen"></a>';
  }
  html +=
    '<input type="hidden" id="upload_in_' +
    campo +
    id2 +
    '" />' +
    '<input type="hidden" id="image_' +
    campo +
    id2 +
    '_temp"  value="' +
    img_default +
    '" />' +
    '<form style="float:left;height:auto;" id="form_' +
    campo +
    id2 +
    '" action="script_upload.php?obj=' +
    MMEE +
    "&tb=" +
    tb +
    "&camp=" +
    campo +
    id2 +
    "&objcam=" +
    campo +
    '" enctype="multipart/form-data" method="post" target="iframe_upload" >' +
    '<table id="image_' +
    campo +
    id2 +
    '_default" cellpadding="0" border="0" cellspacing="0"  class="upload_table1">' +
    '<tr><td align="center" valign="middle" class="upload_table2" width="103" height="93">' +
    '<img src="' +
    img_default +
    '" id="image_' +
    campo +
    id2 +
    '_img" class="upload_img_default"/>' +
    "</td></tr></table>" +
    '<img src="img/cerrarfoto.gif" id="image_' +
    campo +
    id2 +
    '_img_cerrar" class="upload_img_cerrar" ' +
    'style="display:none;" onclick="reset_img_foto(\'' +
    tb +
    "','" +
    campo +
    id2 +
    '\');" title="cerrar"/>' +
    '<span  class="upload_copiando" style=" display:none;" id="image_' +
    campo +
    id2 +
    '_copiando">' +
    '<span class="upload_preview">vista previa</span><br />' +
    '<img src="img/load.gif" />' +
    "</span>" +
    '<div class="upload_controles1" id="image_' +
    campo +
    id2 +
    '_controles1">' +
    '<div id="error_' +
    campo +
    id2 +
    '" class="upload_error"></div>' +
    '<div class="input_file_content">' +
    '<input style="' +
    styleinfi +
    '" type="file" name="v_file_' +
    campo +
    id2 +
    '"   ' +
    "onchange=\"if(this.value!='') upload('" +
    tb +
    "','" +
    campo +
    id2 +
    "'); \" " +
    'class="upload_input_file"  autocomplete="off" />' +
    // '<a rel="width:1100,height:800" style="float:none;" title="Librería de Imágenes" class="mbb" href="library.php?tb='+tb+'&campo='+campo+id2+'">'+
    //'<img align="absmiddle" src="img/ico_library.png">'+
    // 'Cargar de Librería de Imágenes'+
    // '</a>'+
    "</div>" +
    "</div>" +
    "</form>" +
    '<iframe width="300" height="300" frameborder="0" style="position: absolute; display:none;" name="iframe_upload" id="iframe_upload"></iframe>';
  html += "</div>";
  return html;
}

function render_upload_sto(tb, campo, id, name) {
  var id2 = id == "" ? "" : "_" + id;
  var html = '<div class="divupl">';
  if (name != USU_IMG_DEFAULT && name != "") {
    html +=
      '<a class="elim" onclick="eliminar_img_sto(\'' +
      tb +
      "','" +
      campo +
      id2 +
      '\');return false;"  title="eliminar">X</a>';
  }
  html +=
    '<input type="hidden" id="upload_in_' +
    campo +
    id2 +
    '" />' +
    '<span id="txt_' +
    campo +
    id2 +
    '_name" value="' +
    name +
    '" style="float:left;" ></span>' +
    '<form style="float:left;height:auto;" id="form_' +
    campo +
    id2 +
    '" action="script_upload_sto.php?obj=' +
    MMEE +
    "&tb=" +
    tb +
    "&camp=" +
    campo +
    id2 +
    "&objcam=" +
    campo +
    '" enctype="multipart/form-data" method="post" target="iframe_upload" >';
  /*html+='<table id="image_'+campo+id2+'_default" cellpadding="0" border="0" cellspacing="0"  class="upload_table1">'+
		'<tr><td align="center" valign="middle" class="upload_table2">'+
			'<img src="'+img_default+'" id="image_'+campo+id2+'_img" class="upload_img_default"/>'+
		'</td></tr></table>';*/
  html +=
    '<img src="img/cerrarfoto.gif" id="image_' +
    campo +
    id2 +
    '_img_cerrar" class="upload_img_cerrar" ' +
    'style="display:none;" onclick="reset_img_sto(\'' +
    tb +
    "','" +
    campo +
    id2 +
    '\');" title="cerrar"/>' +
    '<span  class="upload_copiando2" style=" display:none;" id="image_' +
    campo +
    id2 +
    '_copiando">' +
    // '<img src="img/load2.gif" />'+
    "</span>" +
    '<span class="upload_controles1" id="image_' +
    campo +
    id2 +
    '_controles1">' +
    '<span class="input_file_content">' +
    '<input style="margin-top:0px;' +
    styleinfi +
    '" type="file" name="v_file_' +
    campo +
    id2 +
    '"   ' +
    "onchange=\"if(this.value!='') upload_sto('" +
    tb +
    "','" +
    campo +
    id2 +
    "'); \" " +
    'class="upload_input_file"  autocomplete="off" />' +
    '<span id="error_' +
    campo +
    id2 +
    '" class="upload_error"></span>' +
    "</span>" +
    "</span>" +
    "</form>" +
    '<iframe width="300" height="300" frameborder="0" style="position: absolute; display:none;" name="iframe_upload" id="iframe_upload"></iframe>';
  html += "</div>";
  return html;
}

/* Fin de Javascript de upload de imagen */

function show_error(a, b) {
  $("error_creacion").innerHTML = b + " : " + errores[a];
}

function show_error_texto(txt) {
  $("error_creacion").innerHTML = txt;
}

function show_error_alert(a) {
  alert(errores[a]);
}

function show_error_alert_text(text) {
  alert(text);
}

function hide_error() {
  $("error_creacion").innerHTML =
    "<span>los campos con * son obligatorios</span>";
}

function set_filas(tb, tbf, val) {
  var eee = 0;

  $$(".braz").each(function (ele) {
    // $(ele).setStyles({'border':'1px solid #CCC'});
    $(ele).removeClass("brasselected");
  });

  $$(".bl").each(function (blo) {
    $(blo).removeClass("modificador_linea");
    $(blo).removeClass("modificador");
    $(blo).removeClass("modificador_grilla");
  });

  // $("set_filas_"+val).setStyles({'border':'1px solid #000'});
  $("set_filas_" + val).addClass("brasselected");

  if (val == "1") {
    $$(".bl").each(function (blo) {
      $("exl_" + blo.get("alt")).setStyles({ display: "none" });
      $("cll_" + blo.get("alt")).setStyles({ display: "" });
    });
  } else if (val == "2") {
    $$(".bl").each(function (blo) {
      $("exl_" + blo.get("alt")).setStyles({ display: "none" });
      $("cll_" + blo.get("alt")).setStyles({ display: "" });
      $(blo).addClass("modificador");
    });
  } else if (val == "3") {
    $$(".bl").each(function (blo) {
      $("exl_" + blo.get("alt")).setStyles({ display: "" });
      $("cll_" + blo.get("alt")).setStyles({ display: "none" });
      $(blo).addClass("modificador_linea");
    });
  } else if (val == "4") {
    $$(".bl").each(function (blo) {
      $("exl_" + blo.get("alt")).setStyles({ display: "none" });
      $("cll_" + blo.get("alt")).setStyles({ display: "" });
      $(blo).addClass("modificador_grilla");
    });
  }

  Cookie.write(tb + "_colap", val, { duration: 10 });
  new Request({
    url:
      "ajax_change_cookie.php?var=" + tb + "_colap" + "&val=" + val + "&ajax=1",
    method: "get",
    onSuccess: function (ee) {
      //	$1( ( (set==1)?"cerrar":"abrir" )+"_crear");
    }
  }).send();
}

function procesar_proyecto() {
  datos = {
    indice: "jsonproy",
    json: $("jjjsonproy").value
  };

  new Request({
    url: "modificar_objeto.php",
    method: "post",
    data: datos,
    onSuccess: function (eee) {
      if (eee.trim() != "") alert(eee);
      else location.href = "maquina.php?rn=" + Math.random() + "#eth";
    }
  }).send();
}

function loadinfopage() {
  if ($("pagespan") && $("pagetime") && $("pagesize")) {
    var timess =
      $("pagesize").value + "Kb generados en " + $("pagetime").value + "s.";
    $("pagespan").innerHTML = timess;
    console.log(timess);
  }
}

function procesar_recargar(urll) {
  //window.open(((Browser.ie)?'../':'')+urll,'proceso','width=850,height=450,scrollbars=yes,menubar=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=140');
  window.open(
    (Browser.ie ? "../" : "") + urll,
    "proceso",
    "width=950,height=450,scrollbars=yes,resizable=no,top=100,left=140"
  );
}

function eliminar_objeto(obj, dis) {
  dis.getParent().getParent().dispose();
  datos = {
    me: obj,
    valor: "destroyobjeto"
  };
  new Request({
    url: "modificar_objeto.php",
    method: "post",
    data: datos,
    onSuccess: function (eee) {
      if (eee.trim() != "") {
        alert(eee);
      } else {
        dis.getParent().getParent().dispose();
      }
    }
  }).send();
}

function eliminar(obj, dis, coman) {
  dis.getParent().getParent().dispose();
  datos = {
    me: obj,
    valor: coman
  };
  new Request({
    url: "modificar_objeto.php",
    method: "post",
    data: datos,
    onSuccess: function (eee) {
      if (eee.trim() != "") {
        alert(eee);
      } else {
        dis.getParent().getParent().dispose();
      }
    }
  }).send();
}

function setqc(clas, set) {
  if ($("quickcontrols")) {
    if (set == 1) {
      $("quickcontrols").addClass(clas);
      $("quickcontrols").addClass("quickcontrolsHover");
    } else {
      $("quickcontrols").removeClass(clas);
    }
  }
}
function cancelar_edit2(me, indice, dis) {
  var parent = $(dis).getParent();
  parent.removeProperty("rel");
  parent.innerHTML = $(me + "_" + indice).getProperty("rel");
}
function edit2(me, indice, dis) {
  if ($(dis).getProperty("rel") != "edit") {
    $(dis).setProperty("rel", "edit");
    $(dis).innerHTML =
      '<input id="' +
      me +
      "_" +
      indice +
      '" type="text" value="' +
      dis.innerHTML +
      '" rel="' +
      dis.innerHTML +
      '"  onkeypress="if(event.keyCode==13){ modificar_dato_valor2(\'' +
      me +
      "','" +
      indice +
      "',this); } if(event.keyCode==27){ cancelar_edit2('" +
      me +
      "','" +
      indice +
      "',this); }\" />";
    $(me + "_" + indice).focus();
  } else {
    /*
		$(dis).removeProperty('rel');
		$(dis).innerHTML=$(me+'_'+indice).getProperty('rel');
		*/
  }
}
function modificar_dato_valor2(me, indice, dis) {
  var parent = $(dis).getParent();
  datos = {
    me: me,
    indice: indice,
    valor: dis.value
  };
  new Request({
    url: "modificar_objeto.php",
    method: "post",
    data: datos,
    onSuccess: function (eee) {
      parent.removeProperty("rel");
      parent.innerHTML = dis.value;
    }
  }).send();
}

Element.Events.hashchange = {
  onAdd: function () {
    var hash = self.location.hash;

    var hashchange = function () {
      if (hash == self.location.hash) return;
      else hash = self.location.hash;

      var value = hash.indexOf("#") == 0 ? hash.substr(1) : hash;
      window.fireEvent("hashchange", value);
      document.fireEvent("hashchange", value);
    };

    if ("onhashchange" in window) {
      window.onhashchange = hashchange;
    } else {
      hashchange.periodical(50);
    }
  }
};

function send_crear(id, tbl, lrp, lrp2) {
  var validacion = true;
  var validacion_text = "";
  $$("." + tbl + "-_" + id).each(function (ele) {
    if (ele.getAttribute("data-vali") == "1") {
      // console.log(ele);
      if (ele.value == "") {
        validacion = false;
        validacion_text = "Hay datos obligatorios que no han sido llenados";
      } else {
        var ffeec2 = eval(
          ele.value.substring(0, 4) * 10000 +
            ele.value.substring(5, 7) * 100 +
            ele.value.substring(8, 10) * 1
        );
        // var ffeec2=ffeec*1;

        var d = new Date();
        var nn = eval(
          d.getFullYear() * 10000 + d.getMonth() * 100 + 100 + d.getDate() * 1
        );

        if (ffeec2 > 20180000)
          if (ffeec2 * 1 < nn * 1) {
            console.log(ffeec2);
            console.log(nn);
            console.log("fecha no valida");
            validacion = false;
            validacion_text = "fecha no válida";
          }
      }
    }
  });

  // $(ii+"_ined").addClass('prog');

  if ($("alert-oblig-" + id)) $0("alert-oblig-" + id);

  if (!validacion) {
    $$("#" + id + "_ined .cr_pl").each(function (ele) {
      if ($("alert-oblig-" + id)) {
        $1("alert-oblig-" + id);
        $("alert-oblig-" + id).innerHTML = validacion_text;
      } else {
        console.log("no validado");
        new Element("div", {
          id: "alert-oblig-" + id,
          html: validacion_text,
          class: "alert-oblig"
        }).inject(ele, "top");
      }
    });

    return;
  }

  var iid;
  var iida = new Array();
  var ht;
  var hta = new Array();
  var hti = 0;
  var datos = {};
  $$("." + tbl + "-_" + id).each(function (ele) {
    iid = ele.id;
    iida = iid.split("-_");
    if (iida[2] != "") {
      eval("datos." + iida[2] + "=ele.value");
    }
  });
  // console.log(datos);

  new Request({
    url: "ajax_sql.php?f=insert&debug=0",
    method: "post",
    data: datos,
    onSuccess: function (ee) {
      var json = eval("(" + ee + ")");
      if (json.success == "1") {
        //alert(ee);
        /*
	if(Recargar=='ajax'){
	//ax("resetear");*/
        // alert(lrp);
        ax(lrp, lrp2, $("pagina").value);
        /*
	$('bloque_content_crear').setStyles({'opacity':'1'});
	} else if(Recargar=='sin_ajax'){
	location.reload();
	}
	*/
      } /*else if(json.success=='0'){
	show_error_texto(json.error);
	$('in_submit').value='crear <?php echo $datos_tabla['nombre_singular']?>';
	$('in_submit').disabled=false;
	$('bloque_content_crear').setStyles({'opacity':'1'});
	}
	*/
    }
  }).send();
}

function changelogin(u, p) {
  var datos = {
    nombre: u,
    password: p,
    v_o: "USUARIOS_ACCESO"
  };
  new Request({
    url: "ajax_sql.php?f=login&debug=0&forge=1",
    method: "post",
    data: datos,
    onSuccess: function (ee) {
      //var json=eval("(" + ee + ")");
      location.reload();
    }
  }).send();
}

function crearforeig(t) {
  var url = "formulario.php?OB=" + o + "&ran=1&proceso=&";
  var datos = {
    nombre: u,
    password: p,
    v_o: "USUARIOS_ACCESO"
  };
  new Request({
    url: "ajax_sql.php?f=login&debug=0&forge=1",
    method: "get",
    data: datos,
    onSuccess: function (ee) {
      //var json=eval("(" + ee + ")");
      location.reload();
    }
  }).send();
}
function load_directlink_filtro_inp(campo, campos_busqueda, tablacampo,objj,extra='') {
  // console.log('pe');
  // console.log({campo,campos_busqueda,tablacampo ,objj});
  new Meio.Autocomplete.Select(
    "filtr_" + campo + "_dl",
    "load_json.php?s=" + campo + "," + campos_busqueda + "|" + tablacampo + "||"+extra,
    {
      minChars: 3,
      selectOnTab: true,
      maxVisibleItems: 12,
      requestOptions: { method: "get" },
      valueField: $("filtr_" + campo),
      valueFilter : function (data) {
        // console.log(data);
        // console.log({campo, tabla, tablacampo});
        // console.log("filtr_" + campo);
        // console.log($("filtr_" + campo));
        // document.getElementById("filtr_" + campo).value='holt';
        setTimeout(function(){
          $("filtr_"+campo).value = tablacampo + "." + campo + "%3D" + data.i;
          render_filder('inner',objj,'');       
        },'10');
        // $("filtr_" + campo).value = tablacampo + "." + campo + "%3D" + data.i;
 
      },
      syncName: false,
      filter: { type: "contains", path: "v" }
    }
  );
}
function load_directlink_filtro_com(
  campo,
  id,
  nombre,
  tabla,
  where,
  tablacampo,
  join,
  extra,
  dli
) {
  new Meio.Autocomplete.Select(
    "filtr_" + campo + "_dl",
    "load_json.php?xt=" +
      extra +
      "&dli=" +
      dli +
      "&s=" +
      id +
      "," +
      nombre +
      "|" +
      tabla +
      "|" +
      where +
      "|" +
      join,
    {
      minChars: 1,
      selectOnTab: true,
      maxVisibleItems: 12,
      requestOptions: {
        method: "get"
      },
      valueField: $("filtr_" + campo),
      valueFilter: function (data) {
        // console.log('filtr_'+campo+'_dl');
        // console.log(data.v);
        $("filtr_" + campo).value = tablacampo + "." + campo + "%3D" + data.i;
        render_filder();

        setTimeout(function () {
          $("filtr_" + campo + "_dl").value = data.v;
        }, 2000);
      },
      syncName: false,
      filter: {
        type: "contains",
        path: "v"
      }
    }
  );
}

function alljsloads() {
  $$(".jsloads").each(function (ele) {
    console.log(ele);
    console.log(ele.value);
    eval(ele.value);
  });
}

function close_multibox() {
  initMultiBox.close();
  setTimeout("initMultiBox.close();", 500);
  setTimeout("alert('ol');", 1500);
  setTimeout("initMultiBox.close();", 2500);
}

function program_alert(ii) {
  $(ii + "_ined").addClass("prog");
  new Element("div", {
    html: "Programar alerta",
    class: "alert-prog"
  }).inject($(ii + "_ined"), "top");
  $(ii + "_ined").addEvent("click", function () {
    program_alert_remove(ii);
  });
}

function program_alert_remove(ii) {
  $(ii + "_ined").removeClass("prog");
  $$("#" + ii + "_ined .alert-prog").destroy();
  $(ii + "_ined").removeEvent("click", destroy);
}

function load_ajax_in(where, get) {
  // console.log(where);
  // console.log(get);
  $(where).innerHTML = '<div class="refreshing">cargando....</div>';
  new Request({
    url: get,
    method: "get",
    evalScripts: true,
    onSuccess: function (ee) {
      $(where).innerHTML = ee;
      // if(typeof(colbac)=='function') eval(colbac);
    }
  }).send();
}

function render_obj(objeto) {
  var json = eval(objeto);
  console.log(json);
  if (objeto == null) return "";
  var html = "<ul>";
  for (var i = 0; i < json.length; i++) {
    html += "<li>" + json[i].name + "</li>";
  }
  html += "</ul>";
  return html;
  // console.log(json);
}

function multi(name) {
  var tor = new Array();
  var i = 0;
  $$(".multisele_" + name).each(function (ee) {
    if ($(ee).checked) {
      tor[i++] = $(ee).value;
    }
  });
  $("in_" + name).value = tor.join(",");
}

function render_multi(name, values) {
  // console.log(values);

  var chekis = document.querySelectorAll(".multisele_" + name);
  chekis.forEach(function (element) {
    element.checked = false;
  });

  if (values != null) {
    var vales = values.split(",");
    for (var i = 0; i < vales.length; i++) {
      // console.log(name+'_'+vales[i]);
      if ($(name + "_" + vales[i])) $(name + "_" + vales[i]).checked = true;
    }
  }
}

function validateEmail(email) {
  if (email == "") return true;

  var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return re.test(email);
}

function validateDni(dni) {
  // console.log(dni);
  if ((!isNaN(dni) && dni.length >= 8 && dni.length <= 11) || dni == "") {
    return true;
  } else {
    return false;
  }
}

function beforemulti() {
  var widthscreen = window.innerWidth;
  if (widthscreen < 700) {
    var mbs = document.getElementsByClassName("mb");
    Object.keys(mbs).map((key, index) => {
      var mb_parts = mbs[key].rel.split(",");
      var new_width = widthscreen - 20;
      var newrel = mbs[key].rel.replace(mb_parts[0], `width:${new_width}`);
      // console.log(newrel);
      mbs[key].setAttribute("rel", newrel);
    });
  }
}

function set_filas_x(tb, val) {
  var $list_ = document.getElementById("list_" + tb);
  $list_.classList.remove("body_modificador");
  $list_.classList.remove("body_modificador_grilla");
  $list_.classList.add("body_" + val);

  // console.log(".list_" + tb + " .bl");
  document.querySelectorAll("#list_" + tb + " .bl").forEach(function (blo) {
    console.log(blo);
    $(blo).removeClass("modificador");
    $(blo).removeClass("modificador_grilla");
    $(blo).addClass(val);
  });

  Cookie.write(tb + "_colap", val, { duration: 10 });
  fetch(`ajax_change_cookie.php?var=${tb}_colap&val=${val}&ajax=1`);
}

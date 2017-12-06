<!DOCTYPE html>
<html>
<head>
  <title>subconscious matrix n-back</title>

  <script src="js/jquery.min.js"></script>
  <script src="js/underscore-min.js"></script>

  <style type="text/css">
  body{
    background-color: black;
    color: green;
  }
  </style>
</head>
<body>
back level <input type="number" value="2" id="level" style="width: 40px;" onchange="refresh();">
variable <input type="checkbox" id="variable" onclick="bVariable=!bVariable" onchange="refresh();">
<span style="display:none;"> q <input type="number" value="100" id="q" style="width: 40px;"></span>
delay <input type="number" value="100" id="delay" style="width: 40px;" onchange="refresh();">
limit <input type="number" value="1000" id="limit" style="width: 40px;" onchange="refresh();">
posibility <input type="number" value="20" id="posibility" style="width: 40px;" onchange="refresh();">
[ <span id="pasadas"></span> ]
<input type="button" value="refresh" onclick="refresh();">
[<a href="#" onclick="alert('Crazy experiment:  subconscious matrix n-back - All square of the matrix are a color n-back mini app running\n contact:robertchalean@gmail.com');">?</a>]

<br><br>

<center>
  <canvas id="myCanvas" width="600px" height="600px"></canvas>
</center>

<script type="text/javascript">

var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");


function n(x){ return parseInt($("#"+x).val()); }

function refresh(){


}


bVariable=0;
matrix=[];
q=n("q");
var kill;

function refresh(){

  for(i=0;i<q;i++){

    matrix[i]=[];

    for(j=0;j<q;j++){

      matrix[i][j]={};

      matrix[i][j].colors=[];

      for(k=0;k<8;k++){
         r=_.random(0,255); g=_.random(0,255); b=_.random(0,255);
         color = "rgb("+r+","+g+","+b+")";
         matrix[i][j].colors[k]=color;

      }

      matrix[i][j].p=n("posibility");

      matrix[i][j].salidas=[];

      if(bVariable){
        matrix[i][j].cantidadBack=_.random(1,n("level"));

      }else{
        matrix[i][j].cantidadBack=n("level");

      }

  
    }
  }

  console.log(matrix)

  pasadas=0; match=0;

  clearInterval(kill)

  kill=setInterval(function(){ life(); },n("delay"));

}

pasadas=0;

match=0;

function life(){

  for(i=0;i<q;i++){
    for(j=0;j<q;j++){

      r=_.random(0,100);

      if(r<=n("posibility") && pasadas>matrix[i][j].cantidadBack ){
        _poner = pasadas-matrix[i][j].cantidadBack;

        matrix[i][j].salidas[pasadas]=matrix[i][j].salidas[_poner];

        match++;

      }else{

        for(;;){

          matrix[i][j].salidas[pasadas]=matrix[i][j].colors[_.random(0,8)];

          if(matrix[i][j].salidas[pasadas]==matrix[i][j].salidas[pasadas-matrix[i][j].cantidadBack]) continue;

          break;
        }
      }

      ctx.fillStyle = matrix[i][j].salidas[pasadas];
      ctx.fillRect( i*6, j*6, 6, 6);

    }
  }

  pasadas++;

  $("#pasadas").html(pasadas);

  if(pasadas==n("limit")){ refresh(); }


}


refresh();

//$("#myCanvas").css("zoom","2");





</script>
</body>
</html>
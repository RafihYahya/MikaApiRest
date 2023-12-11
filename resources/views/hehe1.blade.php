<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .hehe{
        display: grid;
        grid-template-columns: auto auto  ;

          }

    
</style>

<div class="hehe">

    <div class="iframe1">
        <iframe id='miaw1' src={{ $src }}  frameborder="0"></iframe>
    </div>
    <div class="iframe1">
        <iframe id='miaw2'  src={{ $src }}  frameborder="0"></iframe>
    </div>
    <div class="iframe1">
        <iframe id='miaw3' src={{ $src }}  frameborder="0"></iframe>
    </div>
    <div class="iframe1">
        <iframe id='miaw4'  src={{ $src }}  frameborder="0"></iframe>
    </div>
    
</div>


<script>
        
    var iframes = document.getElementById('miaw1');

        iframes.style.width = window.innerWidth/2 + 'px';
        iframes.style.height = window.innerHeight/2 + 'px';

    var iframes2 = document.getElementById('miaw2');

        iframes2.style.width = window.innerWidth/2 + 'px';
        iframes2.style.height = window.innerHeight/2 + 'px';
  
    var iframes3 = document.getElementById('miaw3');

        iframes3.style.width = window.innerWidth/2 + 'px';
        iframes3.style.height = window.innerHeight/2 + 'px';
  
    var iframes4 = document.getElementById('miaw4');

        iframes4.style.width = window.innerWidth/2 + 'px';
        iframes4.style.height = window.innerHeight/2 + 'px';
  
 
 </script>
</body>
</html>
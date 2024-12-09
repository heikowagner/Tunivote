var h=0;


function info(partie)
{

 if (document.getElementById(partie).checked)
 {
                                                          

 
var allH2 = document.getElementsByName("countt");
    
  //alert(allH2.length);
for (var i=0; i-1<allH2.length; i++) {   


  
    if(h>8)
{
alert('prière de sélecter 9 partis au maximum');
  document.getElementById(partie).checked=false;  
  h--;
 break;
}
                 //  alert(partie + i);
              
document.getElementById(partie +"i"+ i).style.display = "table-cell";
      
  }  
  
  
     h++;
}
else
{
    
  var allH2 = document.getElementsByName("countt");   
for (var i=0; i-1<allH2.length; i++) {
document.getElementById(partie +"i"+ i).style.display = "none";
  
  }  
  
   h--;
}


}

function hidecb()
{
var box = document.getElementsByName("partbox") ;
   //NAchledesen wie value ausgelesen werden kann
   var j=0;
    for (var i = 0; i<box.length;  ++i) {
        el = box[i];
        if (el.checked) {
         // alert('checked');
           document.getElementById("part"+i).style.display = "table-row";
          
          j++; 
          if (j % 2 ==0)
          {
          document.getElementById("part"+i).style.backgroundColor = "#white" ;
          }
          else
          {
          document.getElementById("part"+i).style.backgroundColor = "#f0f0f0" ;
          }                       
         
           
           
          //  el.checked = box.checked;
        }
        else
        {
         document.getElementById("part"+i).style.display = "none";       
        }
    }
  //ENDE Kopie  
    
//document.getElementById(partie +"r").style.display = "none";

}

function showcb()
{

var box = document.getElementsByName("partbox") ;
   //NAchledesen wie value ausgelesen werden kann   
    for (var i = 0; i<box.length;  ++i) {
       
    document.getElementById("part"+i).style.display = "table-row";   
      
       if (i % 2 ==0)
          {
          document.getElementById("part"+i).style.backgroundColor = "#f0f0f0" ;
          }
          else
          {
          document.getElementById("part"+i).style.backgroundColor = "white" ;
          }     
    }
    
    
    

}


function pop(page)
{
document.getElementById(page).style.visibility = "visible";

 if (window.pageYOffset)

        ScrollTop = window.pageYOffset;

    else

        ScrollTop = (document.body.parentElement) ? document.body.parentElement.scrollTop : 0;



 //document.getElementById(page).style.left = 100 + "px"  ;
 //document.getElementById(page).style.top = ScrollTop + "px"  ;

document.getElementById(page).style.visibility = "visible";

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    document.getElementById(page).innerHTML=xmlhttp.responseText;
    }
  }


} 


        function popup(page,k)
 {
 pop(page);
   //xmlhttp.open("GET","getreason.php?acro"+=k&qnumer=j&,true);
xmlhttp.open("GET","getpopq.php?qnumber="+k,true);
//document.getElementById(page).innerHTML=xmlhttp.responseText;
xmlhttp.send();
 }


function toggle(theElement) {
    var formElements = theElement.form.elements;
    for (var i = 0, len = formElements.length, el; i < len; ++i) {
        el = formElements[i];
        if (el.type == "checkbox" && el != theElement) {
            el.checked = theElement.checked;
        }
    }
}



function popup2(page,k,j)
 {


 pop(page);
 
//xmlhttp.open("GET","getreason.php?acro"+=k&qnumer=j&,true);
xmlhttp.open("GET","getreason.php?qnumber="+j + "&acro="+k,true);
//document.getElementById(page).innerHTML=xmlhttp.responseText;
xmlhttp.send();



 //document.getElementById(page).style.left = 100 + "px"  ;
// document.getElementById(page).style.top = ScrollTop + "px"  ;
  // document.getElementById(page).style.bottom = 300 +  "px"  ;

 }
 
 
 function poppinfo(page,k)
 {
pop(page);
xmlhttp.open("GET","partinfo.php?acro="+k,true);
xmlhttp.send();
}




 function closepopup(page)
 {
   document.getElementById(page).style.visibility = "hidden";
// document.getElementById(page).innerHTML="<a href=# border:0px onclick=\"closepopup('popup')\">fermer</a>Closed";
  //return;
 }

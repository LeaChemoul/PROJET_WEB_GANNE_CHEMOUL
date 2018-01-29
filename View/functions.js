function masquer_div(id)
{
  event.preventDefault();

  if (document.getElementById(id).style.display === 'none') {
       document.getElementById(id).style.display = 'block';
      document.getElementById(id).scrollIntoView();
  }
  else {
       document.getElementById(id).style.display = 'none';
  }
}


function empecherSaisie()
{
    var soutenance = document.getElementById('euLieu').checked;
     if(!soutenance){
        document.getElementById('siSoutenu').setAttribute("disabled","disabled");
        document.getElementById('note').setAttribute("disabled","disabled")
     }else{
        document.getElementById('siSoutenu').removeAttribute("disabled");
        document.getElementById('note').removeAttribute("disabled");
     }
}
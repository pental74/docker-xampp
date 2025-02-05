var divform = document.getElementById("form");
var divtabella = document.getElementById("tabella");
//nascondi_form(true);
console.log(divform);



function nascondi_form(visibile)
{
    if (visibile==true) 
    {
        divform.style.display="block";
        divtabella.style.display="none";
    }    
    else 
    {
        divform.style.display="none";
        divtabella.style.display="block";
    }    
}
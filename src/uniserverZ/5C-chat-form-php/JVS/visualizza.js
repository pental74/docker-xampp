var divform = document.getElementById("form");
var divtabella = document.getElementById("tabella");
// var form_messaggio = document.forms.form_chat;
// console.log(form_messaggio["inserisci"].onsubmit);
// console.log(form_messaggio["visualizza"].onsubmit);
// if ((form_messaggio["visualizza"].onsubmit!=null) || (form_messaggio["inserisci"].onsubmit!=null))  
// {
//     divform.style.display="none"; alert();

//}

//nascondi_form(true);
//console.log(divform);



function nascondi_form(visibile)
{
    if (visibile==false) 
    {
        divform.style.display="block";
        divtabella.style.display="none";
    }    
    else 
    {
        
        divtabella.style.display="block";
        divform.visibility="hidden";
    }    
}
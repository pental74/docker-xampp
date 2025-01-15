
function stampadati()
{
    // Catturo i valori con getElementiByID
    const nome = document.getElementById("fname");
    const cognome = document.getElementById("lname");
    const username = document.getElementById("uname");
    
    
    console.log(document.getElementsByName("registrazione"));
    console.log(nome.value);
    
    // Inserisce nel paragrafo p 
    document.getElementById("dati").innerHTML = "Contenuto: <br>" + nome.value + 
    "<br>" + cognome.value + "<br>" + username.value;
} 
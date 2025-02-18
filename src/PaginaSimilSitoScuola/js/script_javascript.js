
// Colorazione rossa - viene fatta con il caricamento della pagina

//let body = document.getElementsByTagName("body");
//body[0].style.backgroundColor = "red";
//document.body.style.backgroundColor = "red";

function stampadati()
{
    // Datti provenienti dal form

    // tabella Persona
    const nome = document.getElementById("fname").value;
    const cognome = document.getElementById("lname").value;
    const citta_nascita = document.getElementById("citta_nascita").value;
    const data_nascita = document.getElementById('data_nascita').value;
    const maschile = document.getElementById('maschile').value;
    const femminile = document.getElementById('femminile').value;
    
    const citta_residenza = document.getElementById("citta_residenza").value;
    const via_residenza = document.getElementById("via_residenza").value;
    const telefono = document.getElementById("telefono").value; 
        
    // tabella Account
    const username = document.getElementById("uname").value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // assegnazione al genere l'opzione scelta altrimenti uno dei due rimane vuoto (maschio o femmina)
    let genere;
    if (maschile=="") genere=femminile;
    else genere=maschile;

    // Controllo campi vuoti
    // if (!fname || !lname || !citta_nascita || !data_nascita || !genere || !citta_residenza || !via_residenza || !telefono || !uname || !email || !password)  
    // {
    //     alert('Riempire tutti i campi');
    // }
    if (ControlloCampi(fname, lname, citta_nascita, data_nascita, genere, citta_residenza, via_residenza, telefono, uname, email, password)) 
    {
        // Inserimento dei dati in una tabella
        const tabella = document.getElementById('dati');
        
        // crea una nuova riga .createElement tr
        const riga_risultato = document.createElement('tr');

        // prepara la tupla con i dati del form - è una stringa che apre con '
        riga_risultato.innerHTML = `
            <td>${nome}</td>
            <td>${cognome}</td>
            <td>${citta_nascita}</td>
            <td>${data_nascita}</td>
            <td>${genere}</td>
           
            <td>${citta_residenza}</td>
            <td>${via_residenza}</td>
            <td>${telefono}</td>

            <td>${username}</td>
            <td>${email}</td>
            <td>${password}</td>
        `;

        // aggiunge la riga creata
        tabella.appendChild(riga_risultato);

        // Pulisce i campi del form
        document.getElementById('registrazione').reset();
    }
}

// Controlla se tutti campi contengono dei valori
function ControlloCampi(c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11)
{
        // Controllo campi vuoti
        if (!c1 || !c2 || !c3 || !c4 || !c5 || !c6 || !c7 || !c8 || !c9 || !c10|| !c11)  
            {
                alert('Riempire tutti i campi\nCompletare tutti i campi');
                return false;
            }
        return true
}
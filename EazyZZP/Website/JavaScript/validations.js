// even listener op de telefoon nummer input element
document.getElementById('telefoonNummer').addEventListener('input', (e) => {
    // nieuwe inp opvangen en controleren ...
    let value = e.target.value; 

    // alles verwijderen die geen '+' teken, getal of spatie zijn
    value = value.replace(/[^+\d\s]/g, "");

    // Nederlandse nummer met '+31 6' moet in totaal 13 tekens lang zijn met spaties 
    if (value.length > 13) {
        value = value.slice(0, 13); // haal alles weg na 13e teken
    }

    // om te voorkomen dat mensen andere nummers gebruiken dan Nederlandse
    if (!value.startsWith('+31 6 ')) { 
        value = "+31 6 ";
    }

    // verwijder spaties na 5e index
    if (value.startsWith('+31 6 ')) {
        value = '+31 6 ' + value.slice(5).replace(/\s+/g, ''); 
    }

    e.target.value = value; // value bijwerken
})
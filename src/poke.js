// PokeAPI allows CORS

document.addEventListener('DOMContentLoaded', () => {
    console.log('Using PokeAPI...');
    pokeapiTest();
});

async function pokeapiTest() {
    fetch('https://pokeapi.co/api/v2/pokemon/paras')
    .then((response) => response.json())
    .then((data) => console.log(data));
}
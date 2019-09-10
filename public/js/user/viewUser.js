let parametrosURL = new URLSearchParams(document.location.search.substring(1));

let viewUser = () => {
    let id = parametrosURL.get('id');
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`/user/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('tid').innerHTML = data.id;
        document.getElementById('tcodigo').innerHTML = data.code;
        document.getElementById('tnombre').innerHTML = data.name;
        document.getElementById('temail').innerHTML = data.email;
        document.getElementById('tdescripcion').innerHTML = data.description;
        document.getElementById('tlogin').innerHTML = data.login;
        document.getElementById('tnivel').innerHTML = data.type_level.description;
        document.getElementById('testado').innerHTML = data.account_state.description;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    viewUser();
});
let parametrosURL = new URLSearchParams(document.location.search.substring(1));

let viewClient = () => {
    let id = parametrosURL.get('id');
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/client/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('tid').innerHTML = data.id;
        document.getElementById('tcif').innerHTML = data.cif;
        document.getElementById('tcodigo').innerHTML = data.code;
        document.getElementById('tdescripcion').innerHTML = data.description;
        document.getElementById('tdireccion').innerHTML = data.address;
        document.getElementById('temail').innerHTML = data.email;
        document.getElementById('ttelefono').innerHTML = data.phone;
        document.getElementById('tnotas').innerHTML = data.notes;
        document.getElementById('ttipocliente').innerHTML = data.type_client.description;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    viewClient();
});
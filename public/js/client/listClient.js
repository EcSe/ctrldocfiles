let tbodyClient = document.getElementById('tbodyClient');

let listClient = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    };
    fetch('/client', init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data[i].id}</td>`);
            fila.innerHTML += (`<td>${data[i].cif}</td>`);
            fila.innerHTML += (`<td>${data[i].code}</td>`);
            fila.innerHTML += (`<td>${data[i].description}</td>`);
            fila.innerHTML += (`<td>${data[i].email}</td>`);
            fila.innerHTML += (`<td>${data[i].type_client.description}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/clientedit?id=${data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button></td>`);

            tbodyClient.appendChild(fila);
        }
    });
};

let deleteClient = (e) => {
    let idUser = e.parentNode.parentElement.cells[0].innerHTML;
    let init = {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        mode: 'cors'
    }
    let btnModalDelete = document.getElementById('btnModalDelete');
    document.onclick = (event) => {
        if (event.target == btnModalDelete) {
            fetch(`/client/${idUser}`, init).then(res => res.json()).then(data => {
                let row = e.parentNode.parentElement;
                row.remove()
            });
        }
    }
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    listClient();
});
//#endregion
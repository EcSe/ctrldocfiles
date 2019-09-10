let tbody = document.getElementById('tbody');

let listUser = () => {
    let init = {
        method: "GET",
        mode: 'cors',
    }
    fetch('/user', init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data[i].id}</td>`);
            fila.innerHTML += (`<td>${data[i].code}</td>`);
            fila.innerHTML += (`<td>${data[i].name}</td>`);
            fila.innerHTML += (`<td>${data[i].email}</td>`);
            fila.innerHTML += (`<td>${data[i].description}</td>`);
            fila.innerHTML += (`<td>${data[i].account_state.description}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/usrview?id=${data[i].id}"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/usredit?id=${data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteUser(this)"><i class="fa fa-trash"></i></button></td>`);

            tbody.appendChild(fila);
        }
    })
};

let deleteUser = (e) => {
    let idUser = e.parentNode.parentElement.cells[0].innerHTML;
    let init = {
        method: "DELETE",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        mode: 'cors'
    }
    let btnModalDelete = document.getElementById('btnModalDelete');
    document.onclick = (event) => {
        if (event.target == btnModalDelete) {
            fetch(`/user/${idUser}`, init).then(res => res.json()).then(data => {
                let row = e.parentNode.parentElement;
                row.remove()
            });
        }
    }
};
//#region Llamadas a eventos
document.addEventListener('DOMContentLoaded', () => {
    listUser();
});
//#endregion
let tbody = document.getElementById('tbodyDocument');

let listDocument = () => {
    let init = {
        method: "GET",
        mode: 'cors',
    }
    fetch('/document', init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data[i].id}</td>`);
            fila.innerHTML += (`<td>${data[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${data[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${data[i].description}</td>`);
            fila.innerHTML += (`<td>${data[i].value}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/docview?id=${data[i].id}"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/docedit?id=${data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteDocument(this)"><i class="fa fa-trash"></i></button></td>`);

            tbody.appendChild(fila);
        }
    })
};

let deleteDocument = (e) => {
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
            fetch(`/document/${idUser}`, init).then(res => res.json()).then(data => {
                let row = e.parentNode.parentElement;
                row.remove()
            });
        }
    }
};

//#region Llamadas a eventos
document.addEventListener('DOMContentLoaded', () => {
    listDocument();
});
//#endregion
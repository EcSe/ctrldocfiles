let tbody = document.getElementById('tbody');
let frmSearchUser = document.getElementById('frmSearchUser');

let listUser = (ruta) => {
    frmSearchUser.reset();
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = `${appurl}/userPaginate`;
    let init = {
        method: "get",
        mode: 'cors',
    }
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        for (let i = 0; i < data.listUserPaginate.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.listUserPaginate.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.listUserPaginate.data[i].login}</td>`);
            fila.innerHTML += (`<td>${data.listUserPaginate.data[i].name}</td>`);
            fila.innerHTML += (`<td>${data.listUserPaginate.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.listUserPaginate.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.listUserPaginate.data[i].account_state.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="${appurl}/usrview?id=${data.listUserPaginate.data[i].id}"><i class="fa fa-info"></i></a>
                <a title="Editar" class="btn btn-default" href="${appurl}/usredit?id=${data.listUserPaginate.data[i].id}"><i class="fa fa-edit"></i></a>
                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteUser(this)"><i class="fa fa-trash"></i></button></td>`);

            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="${appurl}/usrview?id=${data.listUserPaginate.data[i].id}">
                                    <i class="fa fa-info"></i></a></td>`);
            }
            tbody.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data.listUserPaginate.from;
        let to = document.getElementById('to');
        to.innerHTML = data.listUserPaginate.to;
        let total = document.getElementById('total');
        total.innerHTML = data.listUserPaginate.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data.listUserPaginate.current_page;
        let hPrev = document.getElementById('hPrev');
        data.listUserPaginate.prev_page_url ? (hPrev.setAttribute('onclick', `return listUser('${data.listUserPaginate.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data.listUserPaginate.next_page_url ? (hNext.setAttribute('onclick', `return listUser('${data.listUserPaginate.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
};

let searchUser = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmSearchUser);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch(`${appurl}/searchUser`, init).then(res => res.json()).then(data => {
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        for (let i = 0; i < data.users.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.users.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.users.data[i].login}</td>`);
            fila.innerHTML += (`<td>${data.users.data[i].name}</td>`);
            fila.innerHTML += (`<td>${data.users.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.users.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.users.data[i].account_state.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="${appurl}/usrview?id=${data.users.data[i].id}"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="${appurl}/usredit?id=${data.users.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteUser(this)"><i class="fa fa-trash"></i></button></td>`);

            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="${appurl}/usrview?id=${data.users.data[i].id}">
                                    <i class="fa fa-info"></i></a></td>`);

            }
            tbody.appendChild(fila);
        }
    });
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
            fetch(`${appurl}/user/${idUser}`, init).then(res => {
                if (!res.ok) {
                    let alertUser = document.getElementById('alertUser');
                    alertUser.className = 'alert alert-danger alert-dismissible';
                    res.json().then(data => {
                        let spnUserMessage = document.getElementById('userMessage');
                        alertUser.style.display = 'block';
                        spnUserMessage.innerHTML = data;
                        setTimeout(() => {
                            alertUser.style.display = 'none';
                        }, 9000);
                    });
                } else {
                    res.json().then(data => {
                        let row = e.parentNode.parentElement;
                        row.remove()
                        let alertUser = document.getElementById('alertUser');
                        alertUser.className = 'alert alert-success alert-dismissible';
                        let spnUserMessage = document.getElementById('userMessage');
                        alertUser.style.display = 'block';
                        spnUserMessage.innerHTML = data;
                        setTimeout(() => {
                            alertUser.style.display = 'none';
                        }, 9000);
                    });
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
};


//#region Llamadas a eventos
document.addEventListener('DOMContentLoaded', () => {
    listUser();
});
frmSearchUser.addEventListener('submit', (e) => {
    searchUser(e);
});
//#endregion
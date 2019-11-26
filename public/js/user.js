let frmAddUser = document.getElementById('frmAddUser');

let listUserState = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/accountState`, init).then(res => res.json()).then(data => {
        let cboAccountState = document.getElementById('accountState');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.text = data[i].description;
            option.value = data[i].id;
            cboAccountState.appendChild(option);
        }
    });
};

let listUserLevel = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/userLevel`, init).then(res => res.json()).then(data => {
        let cboTypeLevel = document.getElementById('typeLevel');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboTypeLevel.appendChild(option);
        }
    });
};

let addUser = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmAddUser);
    let init = {
        method: "POST",
        body: frmData,
    }
    fetch(`${appurl}/user`, init).then(res => {
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
            })
        } else {
            res.json().then(data => {
                frmAddUser.reset();
                let alertUser = document.getElementById('alertUser');
                alertUser.className = 'alert alert-success alert-dismissible';
                let spnUserMessage = document.getElementById('userMessage');
                alertUser.style.display = 'block';
                spnUserMessage.innerHTML = data;
                setTimeout(() => {
                    alertUser.style.display = 'none';
                }, 9000);
            })
        }
    }).catch(err => {
        console.log(err);
    });
};

//#region Llamadas a eventos
frmAddUser.addEventListener('submit', (e) => {
    addUser(e);
});
document.addEventListener('DOMContentLoaded', () => {
    listUserLevel();
    listUserState();
});
//#endregion
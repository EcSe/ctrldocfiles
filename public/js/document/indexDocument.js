let divLoader = document.getElementById('divLoader');
let alertIndex = document.getElementById('alertIndex');
let spnMessage = document.getElementById('indexMessage');
let btnIndex = document.getElementById('btnIndex');

let indexDocument = () => {
    divLoader.style.display = 'block';
    let init = {
        method: 'GET'
    }
    fetch(`${appurl}/indexdocument`, init).then(res => {
        if (!res.ok) {
            alertIndex.className = 'alert alert-danger alert-dismissible';
            res.json().then(data => {
                divLoader.style.display = 'none';
                alertIndex.style.display = 'block';
                spnMessage.innerHTML = data;
            });
            setTimeout(() => {
                alertIndex.style.display = 'none';
            }, 9000);
        } else {
            res.json().then(data => {
                divLoader.style.display = 'none';
                alertIndex.className = 'alert alert-success alert-dismissible';
                alertIndex.style.display = 'block';
                spnMessage.innerHTML = data;
                setTimeout(function() { //Recordar mostraba error porque no enviaba error para mostrar
                    alertIndex.style.display = 'none';
                }, 9000);
            });
        }
    }).catch(err => {
        console.log(err);
    });
}
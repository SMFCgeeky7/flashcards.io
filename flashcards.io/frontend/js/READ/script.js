url = "http://localhost:3000/base/index.php/Flashcards"
estadoModal = "";
window.onload = function () {
    cargarFlashcards()
}

function cargarFlashcards() {
    fetch(url)
        .then(resp => resp.json())
        .then(resp => {
            mostrarFlashcards(resp.data);
        });


}

function mostrarFlashcards(data) {
    
    html = "";
    for (i = 0; i < data.length; i++) {
        html = html + templateFlashcards(data[i], i);
    }
}



function templateFlashcards(obj) {

    titulo = document.getElementById("inpTitulo").value;
    descripcion = document.getElementById("inpDescripcion").value;

    `<div class="card-body">
    <h5 class="card-title">${obj.titulo}</h5>
    <p class="card-text">
        ${obj.descripcion}
    </p>
    <div class="row align-items-end">
        <div class="col">
            <div class="d-grid">
                <button type="button" class="btn btn-primary btn-lg"
                    style="border-bottom-right-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: 5px; border-top-left-radius: 0px;"
                    onclick="btn_ver()" data-bs-toggle="modal" data-bs-target="#myModal">Ver</button>
            </div>

        </div>
        <div class="col">
            <div class="d-grid">
                <button type="button" class="btn btn-primary btn-lg"
                    style="border-bottom-right-radius: 5px; border-top-right-radius: 0px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;"
                    data-bs-toggle="modal" data-bs-target="#myModal" onclick="btn_editar()">Editar</button>
            </div>

        </div>
    </div>
</div>`
}

function btn_guardar(obj) {

    id = document.getElementById("inpId").value;
    titulo = document.getElementById("inpTitulo").value;
    descripcion = document.getElementById("inpDescripcion").value;
    imagen = document.getElementById("imgFile").value;

    if (estadoModal == "Agregar") {
        tipoPeticion = "POST"
        obj = {
            "id":id,
            "titulo": titulo,
            "descripcion": descripcion,
            "imagen": imagen
        }

    } else if (estadoModal == "Editar") {
        tipoPeticion = "PUT"
        obj = {
            "titulo": titulo,
            "descripcion": descripcion,
            "imagen": imagen
        }
    }

    console.log(obj);

    let header = {
        "method": tipoPeticion,
        "body": json.stringify()
    }

    fetch(url, header)
        .then(resp => resp.json())
        .then(resp => {
            console.log(obj)
        });

        
}

function btn_editar() {
    tipoPeticion = "PUT"
}

function btn_agregar() {
    tipoPeticion = "POST"

    titulo = document.getElementById("inpTitulo").value;
    descripcion = document.getElementById("inpDescripcion").value;
    imagen = document.getElementById("imgFile").value;
}

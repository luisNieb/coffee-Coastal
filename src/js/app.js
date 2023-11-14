let paso=1
const pasoInicial=1
const pasofinal=3

const reservacion={
    nombre:'',
    fecha:'',
    hora:'',
    servicios:[]
}

document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion()
    tabs(); //cambia la seccion cuando se presionanlos botones de tabs
    botonesPaginador() //AGREGA O QUITA LOS BOTONES DEL PAGINADOR
    paginaSiguiente()
    paginaAnterior()
    consultarAPI() //consulta  la API en el backend de PHP

    nombreCliente()//
    selecionarFecha()
    seleccionarHora()

    mostrararResumen()//mostrar el resumen del pedido reservacio


}

function mostrarSeccion(){
    //seleccionar la seccion con el paso
    const seccionAnterior = document.querySelector('.mostrar');

    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar')
    }
    
    const seccion= document.querySelector(`#paso-${paso}`)
    seccion.classList.add('mostrar')

    const tabAnterior=document.querySelector('.actual')
    //si tiene la clase la removemos
    if(tabAnterior){
         tabAnterior.classList.remove('actual')
    }
    const tab=document.querySelector(`[data-paso="${paso}"]`)
    tab.classList.add('actual')

}

//FUNCION PAR SELCECIOANAR LOS BOTNES Y PROPORCIONARLES UN EVENTO CLICK
function tabs(){
    //nos retorna un coleccione 
    const botones=document.querySelectorAll(".tabs button");

    //iteramis la colecicones para asignarles a cada uno de ellos un evento click
    botones.forEach(boton=>{
          boton.addEventListener("click",function(e){
               //seleccionamos el elemento actual
            
              //target identifica a que le dimos click target.dataset
               paso=parseInt(e.target.dataset.paso)
            
              // console.log(paso)
               mostrarSeccion()
               botonesPaginador()


              })
            })
}

function botonesPaginador(){

    const paginaAnterior=document.querySelector('#anterior')
    const paginaSiguiente=document.querySelector('#siguiente')

    if(paso===1){
        paginaAnterior.classList.add('ocultar')
        paginaSiguiente.classList.remove('ocultar')
    }else if(paso===3){
        paginaAnterior.classList.remove('ocultar') 
        paginaSiguiente.classList.add('ocultar')
        mostrararResumen()

    }else{
        paginaAnterior.classList.remove('ocultar') 
        paginaSiguiente.classList.remove('ocultar')

    }
    mostrarSeccion()

}

function paginaSiguiente(){
    const paginaAnterior = document.querySelector('#anterior')
    paginaAnterior.addEventListener('click',function(){
        if(paso<=pasoInicial) return
        paso--
        botonesPaginador()

    })
}

function paginaAnterior(){
    const paginaSiguiente = document.querySelector('#siguiente')
    paginaSiguiente.addEventListener('click',function(){
        if(paso>=pasofinal) return
        paso++
        botonesPaginador()

    })
}


async function consultarAPI(){
      try{
        const url="http://localhost:3000/api/servicio"
        //await espera hasta descargar todo
        const resultado=await fetch(url)
        //obtenemos los resultados en formato json
        const servicios =await resultado.json()
     
        mostrarServicios(servicios)
      }catch(error){
        console.log(error)
      }
}

function mostrarServicios(servicios){

      //console.log(servicios)
    servicios.forEach(servicio=>{
        const {id,nombre,descripcion,precio}= servicio
        
        const nombreServicio=document.createElement("P")
        nombreServicio.classList.add('nombre-servicio')
        nombreServicio.textContent=nombre

        const descripcionServicio=document.createElement("P")
        descripcionServicio.classList.add('descripcion-servicio')
        descripcionServicio.textContent=`${descripcion}`

        const precioServicio=document.createElement("P")
        precioServicio.classList.add('precio-servicio')
        precioServicio.textContent=`$ ${precio}`

        const servicioDiv=document.createElement("DIV")
        servicioDiv.classList.add('servicio')
        servicioDiv.dataset.idServicio=id
        //usamos un callback
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio)
        }

        servicioDiv.appendChild(nombreServicio)
        servicioDiv.appendChild(descripcionServicio)
        servicioDiv.appendChild(precioServicio)

        document.querySelector("#servicios").appendChild(servicioDiv)

    })
}

function seleccionarServicio(servicio){
   
     const{ id }=servicio
     console.log()

     const divServicio=document.querySelector(`[data-id-servicio="${id}"]`)
     const {servicios}=reservacion

     //verificamos si ya se agrego el producto por medio de su id usando .some
     if(servicios.some(agregado  => agregado.id===id )){
        console.log("eliminado")
        //el producto ya esta en la lista filtaramos todos excepto el que queremos elimiar
        reservacion.servicios=servicios.filter(esta=>{ esta.id !==id });
        divServicio.classList.remove("seleccionado")
     }else{
         //el producto aun no esta en la lista
         //para que no se duplique valores incertamos una copia del arreglo
         //y agrgamos el nuevo servio a 
        reservacion.servicios=[...servicios ,servicio ]     
        divServicio.classList.add("seleccionado")

     }
    console.log(reservacion)

}

function nombreCliente(){
       reservacion.nombre =document.querySelector("#nombre").value
     
}

function selecionarFecha(){
    const inputFecha = document.querySelector("#fecha")
    inputFecha.addEventListener("input", function(e){
             
        const dia=new Date(e.target.value).getUTCDay()
        if([6,0].includes(dia)){
           e.target.value=""
           mostrarAlerta("No hay reservaciones","error",".formulario")
        }else{
            reservacion.fecha=e.target.value
        }
    })
}

function seleccionarHora(){
    console.log("hola")
    const inputHora=document.querySelector("#hora")
    inputHora.addEventListener('input',function(e){
         const horaReservacion=e.target.value
         //split retorna  un arreglo  la posicion cero es la hora y la posicion 1 son los minutos
         const hora=horaReservacion.split(":")[0]
         if(hora<10 || hora>21){
            e.target.value = ""
            mostrarAlerta("No se disponen de reservacionese en ese horario","error",".formulario")
         }else{
            reservacion.hora=e.target.value
            console.log(reservacion)

         }


    })
}

function mostrarAlerta(mensaje,tipo,elemento,desaparece=true) {
    //previene que se genere  mas de una alerta
    const alertaPrevia=document.querySelector('.alerta')
    if(alertaPrevia){
        alertaPrevia.remove()
    }
    //scripting
     const alerta=document.createElement("div")
     alerta.textContent=mensaje
     alerta.classList.add("alerta")
     alerta.classList.add(tipo)

     const referencia=document.querySelector(elemento)
     referencia.appendChild(alerta)

     //eliminar alerta
     if(desaparece){
        setTimeout(() => {alerta.remove()},3000)

     }
     
}

function mostrararResumen(){
    const resumen= document.querySelector('.contenido-resumen')

   //limpirar el contenido del resumen
   while(resumen.firstChild){
    resumen.removeChild(resumen.firstChild)
   }

      //validamos que le objeto resrevacion no tenga campos vacios
    if(Object.values(reservacion).includes("") || reservacion.servicios.length===0){
        mostrarAlerta("Faltan datos de pedido,Fecha,hora","error",".contenido-resumen",false)
        return
    }
    //formatear el div de resumen
    const {nombre, fecha, hora,servicios}=reservacion

    
   
    //HEading papara los pedidos
   const headingPedidos=document.createElement("h3")
   headingPedidos.textContent="Resumen de los pedidos"
   resumen.appendChild(headingPedidos)

     //Iterando y mostrando los pedidos 
    servicios.forEach(servicio=>{
        const {nombre,descripcion,precio} =servicio

         const contenedorServicio=document.createElement("DIV")   
         contenedorServicio.classList.add("contenedor-servicio")

         const nombreServicio=document.createElement("P")
         nombreServicio.textContent=nombre

         const descripcionServicio=document.createElement("P")
         descripcionServicio.textContent=descripcion
        
         const precioServicio=document.createElement("P")
         const spanPrecio=document.createElement("span")
         spanPrecio.textContent="Precio :"

         precioServicio.appendChild(spanPrecio)
         precioServicio.append(`$${precio}`)


         contenedorServicio.appendChild(nombreServicio)
         contenedorServicio.appendChild(descripcionServicio)
         contenedorServicio.appendChild(precioServicio)

         resumen.appendChild(contenedorServicio)



    })


    const nombreCliente=document.createElement("P") 
    const spanNombre=document.createElement("span")
    spanNombre.textContent="Nombre : "
    nombreCliente.appendChild(spanNombre)
    nombreCliente.append(`${nombre}`)

    //FORMATEAR FECHA
    const fechaObj =new Date(fecha)
    const mes= fechaObj.getMonth()
    const dia= fechaObj.getDate()
    const year= fechaObj.getFullYear()

    const fechaUTC= new Date(Date.UTC(year,mes,dia))
    const opciones={ weekday: "long" , year: 'numeric', month: "long" , day: "numeric"}
    const fechaFormateada= fechaUTC.toLocaleDateString('es-MX',opciones)


    const fechaRe=document.createElement("P") 
    const spanRe=document.createElement("span")
    spanRe.textContent="Fecha : "
    fechaRe.appendChild(spanRe)
    fechaRe.append(`${fechaFormateada}`)

    const horaRE=document.createElement("P") 
    const spanHr=document.createElement("span")
    spanHr.textContent="Hora : "
    horaRE.appendChild(spanHr)
    horaRE.append(`${hora}`)

    const botonRecervar = document.createElement("BUTTON")
    botonRecervar.classList.add('boton')
    botonRecervar.textContent='Reservar '
    botonRecervar.onclick= reservar;

    resumen.appendChild(nombreCliente)
    resumen.appendChild(fechaRe)
    resumen.appendChild(horaRE)
    resumen.appendChild(botonRecervar)

}

function reservar(){

}
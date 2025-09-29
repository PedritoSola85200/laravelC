

window.previewImage =  function (event, querySelector){

	//Recuperamos el input que desencadeno la acción
	let input = event.target;
	
	//Recuperamos la etiqueta img donde cargaremos la imagen
	let imgPreview = document.querySelector(querySelector);

	// Verificamos si existe una imagen seleccionada
	if(!input.files.length) return
	
	//Recuperamos el archivo subido
	let file = input.files[0];

	//Creamos la url
	let objectURL = URL.createObjectURL(file);
	
	//Modificamos el atributo src de la etiqueta img
	imgPreview.src = objectURL;
                
}




	 $('.btn-delete').click(function (e) { 
		e.preventDefault();
 Swal.fire({
  title: "Estas seguro?",
  text: "Desea eliminar este post?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Eliminar",
  cancelButtonText:"Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
	const form = document.getElementById('DeleteForm');
	form.submit();
  }
}); 

	});
/* window.deleteForm = function () {

let from = document.getElementById('form');
form.submit();

  } */
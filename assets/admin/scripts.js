"use strict";
const pathname = window.location.pathname;
const base_url = document.getElementById("base_url").value;
// Función para cambiar el estado Notificaciones
function change(e) {
	// https://es.javascript.info/dom-navigation
	//console.log(e.nextElementSibling.nextElementSibling);
	e.nextElementSibling.nextElementSibling.value = e.checked ? 1 : 0;
}

// llamar al dialogo de pregunta (eliminar)
function delete_item(url, id, text) {
	let data = {
		url: url,
		id: id,
		icon: "success",
		title: text,
	};
	swalConfirmation(data);
}

// definir el Swal
const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: "btn btn-success",
		cancelButton: "btn btn-danger",
	},
	buttonsStyling: false,
});

// Alert de confirmación
function swalConfirmation(data) {
	swalWithBootstrapButtons
		.fire({
			title: "¿Estás seguro de eliminar los datos?",
			text: "¡Tenga en cuenta que esta acción en irreversible!",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Si, Eliminar",
			cancelButtonText: "No, Cancelar",
			reverseButtons: true,
		})
		.then((result) => {
			if (result.isConfirmed) {
				// ejecutar el POST
				executePost(data);
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				/* poner evento */
				/* Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            }) */
			}
		});
}

// Ejecutar un POST
function executePost({
	url = "",
	id = "",
	value = "",
	icon = "success",
	title = "",
}) {
	let data = {
		id: id,
		value: value,
	};

	const base_url = document.getElementById("base_url").value;
	// https://localhost/IoTProject/users_controller/delete_user_profile
	fetch(base_url + url, {
		headers: {
			"Content-Type": "application/json",
		},
		method: "POST",
		body: JSON.stringify(data),
	})
		.then((response) => response.json())
		.then(function (result) {
			console.log(result);

			if (result["status"]) {
				swalTop(icon, title, 3000);
			} else {
				swalTop("error", "¡Error, no está permitida esta acción!", 3000);
			}

			setTimeout(function () {
				window.location.reload(); // recargar la pagina actual
			}, 3000);
		})
		.catch(function (error) {
			console.log(error);
		});
}

// Ejecutar un swal al borde superior derecho
function swalTop(icon, title, timer) {
	Swal.fire({
		position: "top-end",
		icon: icon,
		title: title,
		showConfirmButton: false,
		timer: timer,
	});
}

// validad el numero de serie
const isValidSerialId = (e) => {
	if (e.value === "") {
		document.getElementById("serialnumber").className = ""; // elimina todas las clases
		document
			.getElementById("serialnumber")
			.classList.add("form-control", "error");
		document.getElementById("serialLabel").className = ""; // elimina todas las clases
		document.getElementById("serialLabel").classList.add("text-danger");
		return;
	}
	let data = {
		url: "devices_controller/check_serial_id",
		serialnumber: e.value,
	};
	serialCheck(data);
};
// ejecutar el POST
function serialCheck({ url = "", serialnumber = "" }) {
	let data = {
		serialnumber: serialnumber,
	};
	const base_url = document.getElementById("base_url").value;

	fetch(base_url + url, {
		headers: {
			"Content-Type": "application/json",
		},
		method: "POST",
		body: JSON.stringify(data),
	})
		.then((response) => response.json())
		.then(function (result) {
			if (result["status"]) {
				// si
				document.getElementById("serialnumber").className = ""; // elimina todas las clases
				document
					.getElementById("serialnumber")
					.classList.add("form-control", "error");
				document.getElementById("serialLabel").className = ""; // elimina todas las clases
				document.getElementById("serialLabel").classList.add("text-danger");
				document.getElementById("button").disabled = true;
			} else {
				// no
				document.getElementById("serialnumber").className = ""; // elimina todas las clases
				document
					.getElementById("serialnumber")
					.classList.add("form-control", "focus");
				document.getElementById("serialLabel").className = ""; // elimina todas las clases
				document.getElementById("serialLabel").classList.add("text-primary");
				document.getElementById("button").disabled = false;
			}
		})
		.catch(function (error) {
			console.log(error);
		});
}

// cambiar el estado del almacenamiento
function store(url, id) {
	if (document.getElementById("Switch" + id).checked) {
		document.getElementById("SwitchLabel" + id).innerHTML = "SI";
		let data = {
			url: url,
			id: id,
			value: 1,
			icon: "success",
			title: "¡Almacenado habilitado!",
		};
		// maestra
		executePost(data);
	} else {
		document.getElementById("SwitchLabel" + id).innerHTML = "NO";
		let data = {
			url: url,
			id: id,
			value: 0,
			icon: "warning",
			title: "¡Almacenado deshabilitado!",
		};
		// maestra POST
		executePost(data);
	}
}




/*---------------------------------------------------------------------------
FUNCIONES PARA CONEXIÓN POR MQTT
---------------------------------------------------------------------------*/
// credenciales
const mqtt_token = document.getElementById("mqtt_token").value; // base64
const mqtt_user = document.getElementById("username").value;

// Broker
const mqtt_host = document.getElementById("mqtt_host").value;
const mqtt_port = document.getElementById("mqtt_port").value;
const mqtt_protocol = document.getElementById("mqtt_protocol").value;
// topic & QoS para suscripciones MQTT
const subscription = {
	topic: mqtt_user + "/+/#",
	qos: 0,
};
// Conexión al Broker
// ID de MQTT
const clientId = "mqttjs_iothost" + Math.random().toString(16);
// host = "ws://localhost:8073/mqtt";
const host = `${mqtt_protocol}://${mqtt_host}:${mqtt_port}/mqtt`;
const options = {
	keepalive: 60,
	clientId: clientId,
	username: mqtt_user,
	password: atob(mqtt_token), // docode desde base_64
	clean: true,
	connectTimeout: 30 * 1000, // ms
	reconnectPeriod: 4000, // ms
};
// log
console.log("Connecting mqtt client");
// definir el cliente MQTT
const client = mqtt.connect(host, options);
// Eventos del cliente
client.on("connect", () => {
	console.log("Connection successful");
	doSubscribe();
});
client.on("error", (err) => {
	console.log("Connection error: ", err);
	client.end();
});
client.on("reconnect", () => {
	console.log("Reconnecting...");
});
client.on("message", (topic, message) => {
	console.log(`received message: ${message} from topic: ${topic}`);
	doPaint(message, topic);
});

// Funciones generales
// subscribe topic

const doSubscribe = () => {
	const { topic, qos } = subscription;
	client.subscribe(topic, { qos }, (error, granted) => {
		if (error) {
			console.log("Subscribe error:", error);
			return;
		}
		//subscribedSuccess.value = true;
		console.log("Subscribe successfully:", granted);
	});
};
// publish message

const doPublish = ({ topic, qos = 0, payload }) => {
	client.publish(topic, payload, { qos }, (error) => {
		if (error) {
			console.log("Publish error:", error);
			return;
		}
		console.log(`Published message: ${payload}`);
	});
};
// Procedimiento de dibujar los datos del dispositivo desde el local storage || mantener los datos en el componente
const paintData = (serial, data_device, topic) => {
	const spans = [
		"deviceDS18B20TempCG_" + serial,
		"deviceDS18B20TempFG_" + serial,
		"deviceRestartsG_" + serial,
		"wifiRssiStatusG_" + serial,
		"wifiQualityG_" + serial,
		"deviceCpuTempCG_" + serial,
		"deviceActiveTimeSecondsG_" + serial,
		"wifiIPv4G_" + serial,
	];

	const data = data_device.data;
	// definir y asignar valor al compare para hacer el if
	// if si el topico no tiene nada es que recargue la pag
	// else topico existe es que estoy en la pagina del dashboard y llego mensaje por MQTT
	let compare = "";
	if (topic === "") {
		compare =
			pathname === "/IoTProject/admin/dashboard" ||
			pathname === "/admin/dashboard";
	} else {
		compare =
			topic === mqtt_user + "/" + serial + "/device" &&
			(pathname === "/IoTProject/admin/dashboard" ||
				pathname === "/admin/dashboard");
	}

		// ejecutar la función en diferentes opciones del compare
	if (compare) {
		for (const [key, value] of Object.entries(data)) {
			// Lista de elementos para fijar en su innetHTML span
			spans.forEach(function (span) {
				if (span === key + "G_" + serial) {
					document.getElementById(span).innerHTML = types(value); // entero | string | float redondeado a 2 decimales
				}
			});

		}
	} else if (pathname.includes("view")) {
		//console.log('vista de dispositivos');
		for (const [key, value] of Object.entries(data)) {
			// Lista de elementos para fijar en su innetHTML
			spans.forEach(function (span) {
				if (span === key + "G_" + serial) {
					document.getElementById(span).innerHTML = types(value);

					$("#" + span)
						.val(value)
						.trigger("change");
				}
			});
		}
	}
	
};
// manejo de los mensajes al Dashboard
const doPaint = (message, topic) => {
	const msg = JSON.parse(message);
	// almacenar la data en el local storage del navedador
	localStorage.setItem(msg.deviceMqttId, message);
	// Dibujar los datos desde MQTT y desde el Localstorage
	paintData(msg.deviceMqttId, msg, topic);
};
// funcion tipos
const types = (value) => {
	if (Number.isInteger(value)) {
		return value;
	} else if (typeof value === "string") {
		return value;
	} else {
		return value.toFixed(2);
	}
};
// cuando el DOM este cargado completamente
window.onload = function () {  
    // capturamos todas las clases tipo .devices en un array
	const devices = document.querySelectorAll(".device");
    // recorremos el array sacando el serialid del dispositivo
    devices.forEach((element)=>{
        const serial = element.innerText;
        const data_device = JSON.parse(localStorage.getItem(serial));
        if(data_device != null){
            paintData(serial, data_device, ""); 
        }
    });
}


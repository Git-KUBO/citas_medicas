document.addEventListener('DOMContentLoaded', function() {
    // Buscamos los inputs de fecha y hora en el DOM
    const inputFecha = document.querySelector('input[type="date"]');
    const inputHora = document.querySelector('input[type="time"]');
    const formCita = document.querySelector('form');

    if (formCita && inputFecha && inputHora) {
        formCita.addEventListener('submit', function(event) {
            
            // --- 1. Validar Fines de Semana ---
            // Extraemos los valores manualmente para evitar problemas de zona horaria de JS
            const fechaPartes = inputFecha.value.split('-'); // YYYY-MM-DD
            // Año, Mes (0-11), Día
            const fechaSeleccionada = new Date(fechaPartes[0], fechaPartes[1] - 1, fechaPartes[2]);
            const diaSemana = fechaSeleccionada.getDay();

            // En JS: 0 es Domingo y 6 es Sábado
            if (diaSemana === 0 || diaSemana === 6) {
                event.preventDefault(); // Evita que el formulario se envíe
                alert('Lo sentimos, no laboramos los fines de semana. Por favor, selecciona un día de Lunes a Viernes.');
                return;
            }

            // --- 2. Validar Horario Laboral ---
            const horaApertura = '08:00';
            const horaCierre = '17:00'; // 5:00 PM
            const horaSeleccionada = inputHora.value;

            if (horaSeleccionada < horaApertura || horaSeleccionada > horaCierre) {
                event.preventDefault(); // Evita que el formulario se envíe
                alert(`El horario de atención es de ${horaApertura} AM a ${horaCierre} PM.`);
                return;
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const inputFecha = document.querySelector('input[type="date"]');
    const inputHora = document.querySelector('input[type="time"]');
    const formCita = document.querySelector('form');
    const contenedor = document.querySelector('.container'); // Donde pondremos la alerta

    // Función para crear y mostrar alertas visuales con JS
    function mostrarAlertaJS(mensaje, tipo) {
        // 1. Eliminar alerta previa si existe para que no se acumulen
        const alertaPrevia = document.querySelector('.alerta-dinamica');
        if (alertaPrevia) alertaPrevia.remove();

        // 2. Crear el elemento div
        const divAlerta = document.createElement('div');
        divAlerta.className = `alerta alerta-${tipo} alerta-dinamica`;
        
        // 3. Asignar el icono según el tipo
        let icono = tipo === 'error' ? '❌' : '⚠️';
        divAlerta.innerHTML = `<strong>${icono} Atención:</strong> ${mensaje}`;

        // 4. Insertar la alerta justo antes del formulario
        if (formCita && contenedor) {
            contenedor.insertBefore(divAlerta, formCita);
        }

        // 5. Ocultar automáticamente después de 5 segundos
        setTimeout(() => {
            if(divAlerta) divAlerta.remove();
        }, 5000);
    }

    // Validaciones al enviar el formulario
    if (formCita && inputFecha && inputHora) {
        formCita.addEventListener('submit', function(event) {
            
            // --- Validar Fines de Semana ---
            const fechaPartes = inputFecha.value.split('-'); 
            const fechaSeleccionada = new Date(fechaPartes[0], fechaPartes[1] - 1, fechaPartes[2]);
            const diaSemana = fechaSeleccionada.getDay();

            if (diaSemana === 0 || diaSemana === 6) {
                event.preventDefault(); 
                mostrarAlertaJS('No laboramos los fines de semana. Selecciona un día de Lunes a Viernes.', 'advertencia');
                return;
            }

            // --- Validar Horario Laboral ---
            const horaApertura = '08:00';
            const horaCierre = '17:00';
            const horaSeleccionada = inputHora.value;

            if (horaSeleccionada < horaApertura || horaSeleccionada > horaCierre) {
                event.preventDefault(); 
                mostrarAlertaJS(`El horario de atención es de ${horaApertura} AM a ${horaCierre} PM.`, 'error');
                return;
            }
        });
    }
});

// --- LÓGICA DEL MODAL DE CONFIRMACIÓN (Cancelar/Confirmar Citas) ---
    const botonesConfirmacion = document.querySelectorAll('.btn-delete, .btn-cancel, .btn-confirm');
    
    if (botonesConfirmacion.length > 0) {
        // 1. Inyectamos el HTML del Modal al final del body
        const modalHTML = `
            <div class="modal-overlay" id="custom-confirm">
                <div class="modal-box">
                    <h3>¿Estás seguro?</h3>
                    <p id="confirm-msg">Esta acción no se puede deshacer.</p>
                    <div class="modal-buttons">
                        <button class="btn-no" id="btn-cancelar-modal">No, regresar</button>
                        <button class="btn-yes" id="btn-aceptar-modal">Sí, continuar</button>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // 2. Seleccionamos los elementos del modal
        const modal = document.getElementById('custom-confirm');
        const btnAceptar = document.getElementById('btn-aceptar-modal');
        const btnCancelar = document.getElementById('btn-cancelar-modal');
        const confirmMsg = document.getElementById('confirm-msg');
        let actionUrl = ''; // Aquí guardaremos la URL a la que iba a ir el enlace

        // 3. Agregamos el evento a cada botón
        botonesConfirmacion.forEach(btn => {
            // Importante: Quitamos el 'onclick' nativo que pusimos en PHP
            btn.removeAttribute('onclick');
            
            btn.addEventListener('click', function(event) {
                event.preventDefault(); // Evitamos que cambie de página instantáneamente
                actionUrl = this.getAttribute('href'); // Guardamos el enlace (ej. eliminar_cita.php?id=3)
                
                // Cambiamos texto y color según el botón presionado
                if(this.classList.contains('btn-confirm')) {
                    confirmMsg.textContent = '¿Deseas confirmar esta cita médica?';
                    btnAceptar.style.background = '#28a745'; // Botón verde
                } else {
                    confirmMsg.textContent = '¿Seguro que deseas cancelar esta cita?';
                    btnAceptar.style.background = '#dc3545'; // Botón rojo
                }

                modal.classList.add('active'); // Mostramos el modal
            });
        });

        // 4. Qué pasa si le da a "No"
        btnCancelar.addEventListener('click', () => {
            modal.classList.remove('active'); // Ocultar modal
        });

        // 5. Qué pasa si le da a "Sí"
        btnAceptar.addEventListener('click', () => {
            if(actionUrl) {
                window.location.href = actionUrl; // Redirigir a la URL que teníamos guardada
            }
        });
    }
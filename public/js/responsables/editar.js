/*
 *     Copyright (C) 2019  Luis Cabrera Benito a.k.a. parzibyte
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/*
 *     Copyright (C) 2019  Luis Cabrera Benito a.k.a. parzibyte
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

new Vue({
    el: "#app",
    data: () => ({
        areas: [],
        busqueda: "",
        areaSeleccionada: {},
        mostrar: {
            areas: false,
            aviso: false,
        },
        responsable: {
            nombre: "",
            direccion: "",
            telefono: "",
            contacto: "",
            email: "",
            
            id: null,
        },
        errores: [],
        cargando: false,
        aviso: {},
    }),
    beforeMount() {
        // Separar por / y obtener el ??ltimo elemento
        let idResponsable = window.location.href.split("/").pop();
        HTTP.get("/responsable/" + idResponsable).then(responsable => {
            if (!responsable) {
                alert("El responsable que intentas editar no existe");
                window.location.href = URL_BASE;
                // S?? s?? ya s?? que lo de arriba igualmente detiene la ejecuci??n
                return;
            }
            this.responsable.id = responsable.id;
            this.responsable.nombre = responsable.nombre;
            this.responsable.contacto = responsable.contacto;
            this.responsable.telefono = responsable.telefono;
            this.responsable.email = responsable.email;
            this.responsable.direccion = responsable.direccion;
            this.areaSeleccionada.id = responsable.area.id;
            this.areaSeleccionada.nombre = responsable.area.nombre;
        })

    },
    methods: {
        guardar() {
            this.mostrar.aviso = false;
            if (!this.validar()) return;
            this.cargando = true;
            HTTP
                .put("/responsable", {
                    id: this.responsable.id,
                    nombre: this.responsable.nombre,
                    contacto: this.responsable.contacto,
                    telefono: this.responsable.telefono,
                    email: this.responsable.email,
                    direccion: this.responsable.direccion,
                    areas_id: this.areaSeleccionada.id
                })
                .then(resultado => {
                    resultado && this.resetear();
                    this.mostrar.aviso = true;
                    this.aviso.mensaje = resultado ? "Cambios guardados con ??xito" : "Error editando responsable. Intenta de nuevo";
                    this.aviso.tipo = resultado ? "is-success" : "is-danger";
                })
                .finally(() => this.cargando = false);
        },
        validar() {
            this.errores = [];
            if (!this.responsable.nombre.trim())
                this.errores.push("Escribe el nombre");
            if (this.responsable.nombre.length > 255)
                this.errores.push("El nombre no debe contener m??s de 255 caracteres");
            if (!this.responsable.direccion.trim())
                this.errores.push("Escribe la direccion");
            if (this.responsable.direccion.length > 255)
                this.errores.push("La direcci??n no debe contener m??s de 255 caracteres");
            if (!this.areaSeleccionada.id)
                this.errores.push("Selecciona un ??rea");
            return this.errores.length <= 0;
        },
        seleccionarArea(area) {
            this.areaSeleccionada = area;
            this.mostrar.areas = false;
        },
        resetear() {
            this.areas = [];
            this.areaSeleccionada = {};
            this.responsable.nombre = "";
            this.responsable.direccion = "";
            this.responsable.contacto = "";
            this.responsable.telefono = "";
            this.responsable.email = "";

            this.errores = [];
            this.cargando = false;
            this.busqueda = "";
        },
        buscarArea: debounce(function () {
            if (!this.busqueda) return;
            HTTP.get("/areas/buscar/" + encodeURIComponent(this.busqueda))
                .then(areas => this.areas = areas.data)
        }, 500)
    }
});
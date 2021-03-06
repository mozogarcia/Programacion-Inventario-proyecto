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
        articulo: {
            fechaAdquisicion: "",
            codigo: "",
            numeroFolioComprobante: "",
            descripcion: "",
            marca: "",
            modelo: "",
            serie: "",
            estado: "regular",
            observaciones: "",
            costoAdquisicion: "",
            cantidad: "",
            
        },
        errores: [],
        cargando: false,
        aviso: {},
    }),
    methods: {
        guardar() {
            this.mostrar.aviso = false;
            if (!this.validar()) return;
            this.cargando = true;
            HTTP
                .post("/articulo", {
                    fechaAdquisicion: this.articulo.fechaAdquisicion,
                    codigo: this.articulo.codigo,
                    numeroFolioComprobante: this.articulo.numeroFolioComprobante,
                    descripcion: this.articulo.descripcion,
                    marca: this.articulo.marca,
                    modelo: this.articulo.modelo,
                    serie: this.articulo.serie,
                    estado: this.articulo.estado,
                    observaciones: this.articulo.observaciones,
                    costoAdquisicion: this.articulo.costoAdquisicion,
                    cantidad: this.articulo.cantidad,
                    areas_id: this.areaSeleccionada.id
                })
                .then(resultado => {
                    resultado && this.resetear();
                    this.mostrar.aviso = true;
                    this.aviso.mensaje = resultado ? "Art??culo agregado con ??xito" : "Error agregando art??culo. Intenta de nuevo";
                    this.aviso.tipo = resultado ? "is-success" : "is-danger";
                })
                .finally(() => this.cargando = false);

        },
        validar() {
            this.errores = [];
            if (!this.articulo.fechaAdquisicion.trim())
                this.errores.push("Selecciona la fecha de adquisici??n");
            if (!this.articulo.codigo.trim())
                this.errores.push("Escribe el c??digo del art??culo");
            if (this.articulo.codigo.length > 255)
                this.errores.push("El c??digo no debe contener m??s de 255 caracteres");
            if (!this.articulo.descripcion.trim())
                this.errores.push("Escribe la descripci??n del art??culo");
            if (this.articulo.descripcion.length > 255)
                this.errores.push("La descripci??n no debe contener m??s de 255 caracteres");
            if (!this.articulo.estado)
                this.errores.push("Selecciona el estado del art??culo");
            if (!parseFloat(this.articulo.costoAdquisicion))
                this.errores.push("Escribe el costo de adquisici??n del art??culo");
            if (parseFloat(this.articulo.costoAdquisicion) <= 0)
                this.errores.push("El costo de adquisici??n debe ser mayor a 0");
            if (parseFloat(this.articulo.costoAdquisicion) > 99999999.99)
                this.errores.push("El costo de adquisici??n debe ser menor que 100000000");

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
            this.articulo = {
                fechaAdquisicion: "",
                codigo: "",
                numeroFolioComprobante: "",
                descripcion: "",
                marca: "",
                modelo: "",
                serie: "",
                estado: "regular",
                observaciones: "",
                costoAdquisicion: "",
                cantidad: "",
            };
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
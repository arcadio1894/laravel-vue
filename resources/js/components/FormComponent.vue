<template>
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" v-on:submit.prevent="create">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="nombre_producto" >Nombre</label>
                            <input id="nombre_producto" type="text" class="form-control" v-model="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio_producto" >Precio</label>
                            <input id="precio_producto" type="number" step="0.01" class="form-control" v-model="precio">
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="form-group col-md-12">
                        <label for="descripcion_producto" >Descripcion</label>
                        <input id="descripcion_producto" type="text" class="form-control" v-model="descripcion">
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" v-on:click="onClickCancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
            <div v-if="errors">
                <tr v-for="error in errors">
                  <div class="alert alert-danger">
                    {{error}}
                  </div>
                </tr>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
              name:'',
              errors:false,
              precio:'',
              descripcion:'',
            }
        },
        methods: {
          create() {
            const params = {
              name: this.name,
              precio: this.precio,
              descripcion: this.descripcion,
            };
            axios.post('/product', params).then(response => {
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Registrado correctamente',
                    icon: 'success'
                })
                this.$emit('create');
                this.errors = false;
                $('#create').modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
                var texto="";
                for (var property in error.response.data.errors){
                    texto = texto + error.response.data.errors[property]+'\n';
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'warning',
                    title : texto
                })
            });
          },
          onClickCancel() {
              this.errors=false;
          },
        }
    }
</script>

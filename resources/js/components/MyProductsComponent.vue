<template>
    <div class="col-md-12">
        <h4 class="section-title-underline mb-2">
            <span>Productos</span>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                Nuevo Producto
            </button>
        </h4>
        <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                  <product-component v-for="(product, index) in products" v-bind:key="product.id"
                      v-bind:product="product"
                      v-on:delete="deleteProduct(index)"
                      v-on:modal="showModal(index, ...arguments)">
                  </product-component>
              </tbody>
            </table>
        </div>


        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title">Edit producto</h5>
                        <button type="button" class="close" data-dismiss="modal" v-on:click="onClickCancel" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" v-on:submit.prevent="update">
                      <div class="modal-body">
                          <div class="form-group row">
                              <div class="form-group col-md-4">
                                  <label for="nombre_edit" >Nombre</label>
                                  <input id="nombre_edit" type="text" class="form-control" v-model="nameEdit">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="precio_edit" >Precio</label>
                                  <input id="precio_edit" type="number" step="0.01" class="form-control" v-model="precioEdit">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="visibilidad_edit">Visibilidad</label>
                                  <select class="form-control" id="visibilidad_edit" v-model="habilitadoEdit">
                                      <option selected value="1">Habilitado</option>
                                      <option value="0">Deshabilitado</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="form-group col-md-12">
                                <label for="descripcion_edit" >Descripcion</label>
                                <input id="descripcion_edit" type="text" class="form-control" v-model="descriptionEdit">
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" v-on:click="onClickCancel" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Actualizar</button>
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
        <form-component v-on:create="getProducts"/>
    </div>
  </template>

<script>
    export default {
        props: [''],
        data() {
            return {
              products:[],
              errors:false,
              openModal:false,
              idEdit:'',
              nameEdit: '',
              descriptionEdit:'',
              precioEdit:'',
              habilitadoEdit:'',
            }
        },
        mounted() {
          this.getProducts();
        },
        methods: {
          getProducts(){
            axios.get('product').then(
                (response) => {
                    this.products = response.data
                }
            )
          },
          deleteProduct(index) {
              this.getProducts();
          },
          showModal(index, product){
              this.openModal = true;
              this.idEdit = product.id;
              this.nameEdit = product.name;
              this.descriptionEdit = product.descripcion;
              this.precioEdit = product.precio;
              this.habilitadoEdit = product.habilitado;
              $('#edit').modal('show');
          },
          onClickCancel() {
                this.openModal = false;
                this.idEdit = "";
                this.nameEdit = "";
                this.descriptionEdit = "";
                this.precioEdit = "";
                this.habilitadoEdit = "";
                this.errors=false;
                $('#edit').modal('hide');
          },
          update(){
              const params = {
                  id:this.idEdit,
                  name:this.nameEdit,
                  descripcion:this.descriptionEdit,
                  precio:this.precioEdit,
                  habilitado:this.habilitadoEdit,
              };
              axios.put('/product/'+this.idEdit, params).then(response => {
                  Swal.fire({
                      title: 'Correcto!',
                      text: 'Registrado correctamente',
                      icon: 'success'
                  })
                  $('#edit').modal('hide');
                  this.errors=false;
                  this.getProducts();
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
          }
        }
    }
</script>

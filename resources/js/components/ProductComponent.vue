<template>
    <tr>
      <td><input type="checkbox" v-bind:value="product.id" v-model="checked"></td>
      <td>{{product.name}}</td>
      <td>{{product.descripcion}}</td>
      <td>{{formatPrice(product.precio)}}</td>
      <td>
        <i class="btn btn-warning fas fa-pencil-alt" v-on:click="onClickEdit""></i>
        <i class="btn btn-danger fas fa-trash-alt" v-on:click="onClickDelete""></i>
      </td>
    </tr>
</template>

<script>
    export default {
        props: ['product'],
        data() {
            return {
              editMode: false,
              checked: [],
            }
        },
        filters: {

        },
        mounted() {

        },
        watch: {
          checked: function(){
            if(this.checked == this.product.id)
            {
              this.$emit('add', this.product.id);
            }else{
              this.$emit('remove', this.product.id);
            }
          }
        },
        methods:{
          onClickEdit() {
            this.$emit('modal', this.product);
          },
          onClickDelete() {
            Swal.fire({
              title: 'Eliminacion!',
              text: "Desea eliminar "+this.product.name,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Elminiar!'
            }).then((result) => {
              if (result.value) {
                  axios.delete('/product/'+this.product.id,{ data: { id: this.product.id, } }).then(response => {
                    Swal.fire({
                        title: 'Correcto!',
                        text: 'Registrado correctamente',
                        icon: 'success'
                    })
                    this.$emit('delete');

                  }).catch(error =>{
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
            })
          },
          formatPrice(value) {
              let val = (value/1).toFixed(2).replace('.', ',')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
          }
        }
    }
</script>

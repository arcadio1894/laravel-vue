<template>
    <div class="col-md-12">
           <form v-on:submit.prevent="newProduct">
               <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">Nombre</label>
                        <input v-model="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="description">Descripción</label>
                        <input v-model="description" type="text" class="form-control" id="description">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="precio">Precio</label>
                        <input v-model="precio" type="text" class="form-control" id="precio">
                    </div>
                     <div class="form-group col-md-3">
                         <label for="habilitado"> </label>
                        <div class="form-check">
                            <input type="checkbox" id="checkbox" v-model="habilitado">
                            <label class="form-check-label" for="checkbox">
                                Habilitado
                            </label>
                            </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            <br>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:'',
                description:'',
                precio:0,
                habilitado:false
            }
        },
        created(){
            console.log('Component mounted.')
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newProduct(){
                const params = {
                    name:this.name,
                    description:this.description,
                    precio:this.precio,
                    habilitado:this.habilitado
                };

                this.name='';
                this.description='';
                this.precio=0;
                this.habilitado=false;

                //Peticion axios
                axios.post('/products',params)
                    .then(
                        (response)=>{
                            const product = response.data
                            this.$emit('new',product);
                        }
                    )
            }
        }
    }
</script>

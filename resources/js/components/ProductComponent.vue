<template>

    <tr>
    <td v-text="index+1"></td>
    <td v-if="editMode"><input v-model="product.name" type="text" class="form-control" id="name"></td>
    <td v-else v-text="product.name"></td>
    <td v-if="editMode"><input v-model="product.description" type="text" class="form-control" id="description"></td>
    <td v-else v-text="product.description"></td>
    <td v-if="editMode"><input v-model="product.precio" type="text" class="form-control" id="precio"></td>
    <td v-else v-text="product.precio"></td>
    <td><input type="checkbox" id="checkbox" v-model="product.habilitado"></td>
    <td>
        <div v-if="editMode">
            <button  class="btn btn-primary" 
                 v-on:click="onClickUpdate"><i class="fas fa-save"></i></button>
            <button  class="btn btn-primary"
                v-on:click="onClickCancel"><i class="fas fa-ban"></i></button>
        </div>
        <div v-else>
            <button class="btn btn-primary"
                v-on:click="onClickEdit"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger"
                v-on:click="onClickDelete"><i class="fas fa-trash-alt"></i></button>
        </div>
    </td>
    </tr>

</template>

<script>
    export default {
        props:['product','index'],
        data(){
            return{
                editMode:false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onClickEdit(){
                this.editMode=true;
            },
            onClickCancel(){
                this.editMode=false;
            },
            onClickDelete(){
                axios.delete('/products/'+this.product.id)
                    .then(
                        ()=>{
                            this.$emit('delete');
                        }
                    )
            },
            onClickUpdate(){
                const params = {
                    name:this.product.name,
                    description:this.product.description,
                    precio:this.product.precio,
                    habilitado:this.product.habilitado,
                };

                axios.put('/products/'+this.product.id,params)
                    .then(
                        (response)=>{
                            this.editMode=false;
                            const product = response.data;
                            this.$emit('update',product)
                        }
                    )
            }
        }
    }
</script>

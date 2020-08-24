<template>
    <div class="col-md-12">

        <form-component v-on:new="addProduct"></form-component>

        <div class="col-md-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">N°</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Habilitado</th>
                <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                 <product-component
                    v-for="(product, index) in product"
                    v-bind:index="index"
                    v-bind:key="product.id"
                    v-bind:product="product"
                    v-on:delete="deleteProduct(index)"
                    v-on:update="updateProduct(index,...arguments)">
                </product-component>
            </tbody>
        </table>

    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                product: []
            }
        },
        mounted() {
            axios.get('/products')
                .then(
                    (response)=>{
                        console.log(response);
                        this.product=[];
                        this.product=response.data
                    }
                )
        },
        methods:{
            addProduct(product){
                this.product.push(product)
            },
            deleteProduct(index){
                this.product.splice(index,1)
            },
            updateProduct(index,product){
                this.product[index]=product;
            }
        }
    }
</script>

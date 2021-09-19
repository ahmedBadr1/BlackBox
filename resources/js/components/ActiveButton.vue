<template>
        <div class="">
            <button class="btn btn-danger" @click="toggleActive" v-html="btnHtml"></button>
        </div>
</template>

<script>
export default {
    props: ['stateId','active'],
    mounted() {
       // console.log('Component mounted.'+this.stateId)
    },
    data:function (){
        return{
            status: this.active,
        }
    },

    methods: {
        toggleActive(){
            axios.post('/states/toggle/'+ this.stateId)
                .then(response =>{
                    this.status = !this.status;
                    console.log(response.data);
                });
        },
    },
    computed:{
        btnHtml(){
            return (this.status) ? '<i class="fas fa-meh"></i>':'<i class="fas fa-smile-beam"></i>';
        }
    },
}
</script>

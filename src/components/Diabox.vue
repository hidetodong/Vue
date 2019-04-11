<template>
    <div>
        <div v-for="x in msg_info"><p>{{x.name}}:{{x.msg}}</p></div>
        
    </div>
</template>

<script>
export default {
    name:'diabox',
    data () {
        return {
            user_msg:[
               
                 
            ]
        }
    },
    computed: {
        msg_info () {
             return this.$store.state.msglist
        }
    },
    methods: {

    }
}
</script>

<style scoped>

    p{
        border-radius: 20px;
        border:1px solid;
        display: inline-block;
        padding: 5px 1% 5px 1%;
        margin-left: 3%;
        margin-top: 1%;
        font-size: 16px;

    }

</style>


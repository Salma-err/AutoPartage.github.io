console.log('Commencer')

const mycomp = {
    data() {
        return {
            mydate: null,
            mytime: null
        }
    },
    methods: {

    }
}
const myApp = Vue.createApp(mycomp).mount('#myapp')
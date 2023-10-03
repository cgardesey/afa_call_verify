import VModal from "vue-js-modal";

require('./bootstrap');

import Vue from 'vue'
import PlaceCall from "./components/PlaceCall";

window.Event = new Vue();

new Vue({
    el: '#app',
    components: {
        PlaceCall
    },
    data() {
        return {

        }
    },

    methods: {

    }
});

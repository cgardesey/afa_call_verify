import AppForm from '../app-components/Form/AppForm';

Vue.component('call-log-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                caller_phonenumber:  '' ,
                callee_phonenumber:  '' ,
                call_id:  '' ,
                user_id:  '' ,
                
            }
        }
    }

});
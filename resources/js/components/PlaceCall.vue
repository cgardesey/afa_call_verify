<template>
    <div class="container">
        <flash-message></flash-message>
        <div class="container mt-5">
            <h1>Call Verify</h1>
            <form @submit.prevent="onSubmit">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="caller_phonenumber">Caller Phone Number</label>
                        <input type="tel" id="caller_phonenumber" name="caller_phonenumber" v-model="form.caller_phonenumber" class="form-control" placeholder="0540505362" pattern="^(0\d{9})$" required>
                    </div>
                    <div class="col-md-6">
                        <label for="callee_phonenumber">Callee Phone Number</label>
                        <input type="tel" id="callee_phonenumber" name="callee_phonenumber" v-model="form.callee_phonenumber" class="form-control" placeholder="0540505362" pattern="^(0\d{9})$" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button id="call-button" class="btn btn-primary"type="submit" >Call</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import FlashMessage from '@smartweb/vue-flash-message';
import Swal from 'sweetalert2';
window.Vue = require('vue');
Vue.use(FlashMessage);

const https = require('https');

    export default {
        components: {
            FlashMessage
        },
        data() {
            return {
                form: {
                    caller_phonenumber: '',
                    callee_phonenumber: '',
                }
            }
        },

        methods: {
            onSubmit() {
                let roomNumber = Math.floor(Math.random() * 90000000) + 10000000;
                const agent = new https.Agent({
                    rejectUnauthorized: false
                });
                axios.post('http://localhost:50003/group-call', this.form)
                    .then(response => {
                        this.form.callee_phonenumber = '';
                        console.log(response.data);
                        /*this.flashMessage.success({
                            title: 'Success',
                            message: 'Call successfully initiated!'
                        });*/
                        if (JSON.stringify(response).includes('Invite action successfully executed for use')) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Call successfully initiated',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }
                        else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error occured',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error occured',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        }
    }
</script>

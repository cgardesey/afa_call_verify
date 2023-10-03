import AppListing from '../app-components/Listing/AppListing';

Vue.component('call-log-listing', {
    mixins: [AppListing],
    props: {
        users: Array
    },
    methods: {
        getName(user_id) {
            return (this.users.find(option => option.user_id === user_id)).name;
        },
        getEmail(user_id) {
            return (this.users.find(option => option.user_id === user_id)).email;
        }
    }
});

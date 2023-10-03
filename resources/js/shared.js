export default {
    methods: {
        resumeTimer() {
            this.socket.emit(
                "start-timer", {'user_id': this.user_id}
            );
        }
    },
    /*mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    destroyed() {
        window.removeEventListener("scroll", this.handleScroll);
    }*/
};
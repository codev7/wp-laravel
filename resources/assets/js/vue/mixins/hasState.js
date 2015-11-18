export default {
    props: {
        state: {
            type: String,
            required: true
        }
    },

    attached() {
        this.state = JSON.parse(this.state);
    }
}

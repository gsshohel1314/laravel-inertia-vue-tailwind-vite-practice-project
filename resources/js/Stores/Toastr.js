import { reactive } from "vue";

export default reactive({
    items: [
        // {key: Date.now() + Math.random(), message: 'Set yourselt free.', title: 'Created', type: 'success' },
        // {key: Date.now() + Math.random(), message: 'Custom message.', title: 'Deleted', type: 'success' },
    ],

    add(messageObject) {
        this.items.unshift({
            key: Date.now() + Math.random(),
            ...messageObject
        });
    },

    remove(index) {
        this.items.splice(index, 1);
    }
})
<template>
    <div>
        <h1>{{ department ? 'Edit Department' : 'Add Department' }}</h1>
        <form @submit.prevent="submitForm">
            <input v-model="form.name" type="text" placeholder="Department Name" required />
            <button type="submit">{{ department ? 'Update' : 'Create' }}</button>
            <button @click="$emit('close')">Cancel</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['department'],
    data() {
        return {
            form: {
                name: this.department ? this.department.name : '',
            },
        };
    },
    methods: {
        async submitForm() {
            if (this.department) {
                await axios.put(`/api/departments/${this.department.id}`, this.form);
            } else {
                await axios.post('/api/departments', this.form);
            }
            this.$emit('close');
        },
    },
};
</script>
